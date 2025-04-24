<?php

namespace App\Http\Controllers\Chat;

use App\Events\MarkAsReadEvent;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{


    public function index()
    {

        $user = Auth::user();

        $contacts = $this->getContactsWithDetails($user);

        return view('buyer.chat.messages', compact('contacts'));
    }



    public function getConversation($otherUserId)
    {

        $user = Auth::user();
        $authId = $user->id;

        $contacts = $this->getContactsWithDetails($user);
        $contactChat = User::findOrFail($otherUserId);



        try {
            $this->authorize('conversation', $contactChat);
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {

            return abort(404);
        }


        $messages = Message::where(function ($query) use ($authId, $otherUserId) {
            $query->where('sender_id', $authId)
                ->where('receiver_id', $otherUserId);
        })
            ->orWhere(function ($query) use ($authId, $otherUserId) {
                $query->where('sender_id', $otherUserId)
                    ->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) use ($authId) {

                $test = $message->full_datetime;

                // make is_read true:
                if ($message->receiver_id == $authId && !$message->is_read) {
                    $message->is_read = true;
                    $message->save();
                }

                return $message;
            });

        broadcast(new MarkAsReadEvent($otherUserId, $authId))->toOthers();

        return view('buyer.chat.conversation', compact('messages', 'contacts', 'contactChat'));
    }



    private function getContactsWithDetails($user)
    {

        $contacts = $user->contacts();

        $contactsWithDetails = $contacts->map(function ($contact) use ($user) {

            $lastMessage = Message::where(function ($query) use ($user, $contact) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', $contact->id);
            })
                ->orWhere(function ($query) use ($user, $contact) {
                    $query->where('sender_id', $contact->id)
                        ->where('receiver_id', $user->id);
                })
                ->orderBy('created_at', 'desc')
                ->first();

            $unreadCount = Message::where('sender_id', $contact->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)
                ->count();


            $contact->last_message = $lastMessage;
            $contact->unread_count = $unreadCount;

            return $contact;
        });

        return $contactsWithDetails->sortByDesc(function ($contact) {
            return $contact->last_message->created_at;
        });
    }






    // send message :
    public function sendMessage(Request $request)
    {

        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->message,
        ]);


        $unreadCount = Message::where('sender_id', Auth::user()->id)
            ->where('receiver_id', $request->receiver_id)
            ->where('is_read', false)
            ->count();


        broadcast(new MessageSent($message, $unreadCount))->toOthers();

        return response()->json(['success' => true, 'message' => $message, 'full_datetime' => $message->full_datetime]);
    }




    public function markAsRead(Request $request)
    {
        $user_seen_id = Auth::user()->id;

        $user_send_msg = $request->input('sender_id');


        Message::where('sender_id', $user_send_msg)
            ->where('receiver_id', $user_seen_id)
            ->where('is_read', false)
            ->update(['is_read' => true]);


        broadcast(new MarkAsReadEvent($user_send_msg, $user_seen_id))->toOthers();

        return response()->json(['status' => 'broadcasted']);
    }
}
