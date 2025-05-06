<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationMail;
use App\Models\User;


class VerificationController extends Controller
{

    public function ShowMessage()
    {
        return view('emails.notice.messages');
    }

    public function verify($id, $token)
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->route('verification.notice')->with(['status' => 'warning', 'message' => 'Your email is already activated']);
        }

        $user = User::where('verification_token', $token)->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('verification.notice')->with(['status' => 'error', 'message' => 'Invalid verification code.']);
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        return redirect()->route('verification.notice')->with(['status' => 'success', 'action' => 'verify-done', 'message' => 'Your email has been verified successfully.']);
    }

    public function send()
    {
        $user = Auth::user();

        if ($user->email_verified_at) {
            return redirect()->route('verification.notice')->with(['status' => 'warning', 'message' => 'Your email is already activated']);
        }


        $user->update([
            'verification_token' => Str::random(60)
        ]);


        Mail::to($user->email)->send(new VerificationMail($user));

        return redirect()->route('verification.notice')->with(['status' => 'success', 'action' => 'send-email', 'message' => 'Verification email has been sent successfully!']);
    }
}
