<?php

namespace App\Http\Controllers\Chat;

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

        $contacts = $user->contacts();

        $contactsWithLastMessage = $contacts->map(function ($contact) use ($user) {

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

            $contact->last_message = $lastMessage;

            return $contact;
        });


        return view('buyer.chat.messages', compact('contactsWithLastMessage'));
    }



    public function getConversation($otherUserId)
    {

        $user = Auth::user();

        $authId = Auth::id();

        $messages = Message::where(function ($query) use ($authId, $otherUserId) {
            $query->where('sender_id', $authId)
                ->where('receiver_id', $otherUserId);
        })
            ->orWhere(function ($query) use ($authId, $otherUserId) {
                $query->where('sender_id', $otherUserId)
                    ->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();



        dd($messages);
    }
}
