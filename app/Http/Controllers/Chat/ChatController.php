<?php

namespace App\Http\Controllers\Chat;

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

        // dd($contacts);

        return view('buyer.chat.messages', compact('contacts'));
    }



    public function getConversation($otherUserId)
    {

        $user = Auth::user();
        $authId = $user->id;

        $contacts = $this->getContactsWithDetails($user);
        $contactChat = User::findOrFail($otherUserId);


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
            ->map(function ($message) {

                $test = $message->full_datetime;
                return $message;
            });


        return view('buyer.chat.conversation', compact('messages', 'contacts', 'contactChat'));
    }






    private function getContactsWithDetails($user)
    {

        $contacts = $user->contacts();

        return $contacts->map(function ($contact) use ($user) {
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
    }










    // send message :
    public function sendMessage(Request $request)
    {

        // dd($request);
        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->message,
        ]);


        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['success' => true, 'message' => $message, 'full_datetime'=> $message->full_datetime]);
    }
}
