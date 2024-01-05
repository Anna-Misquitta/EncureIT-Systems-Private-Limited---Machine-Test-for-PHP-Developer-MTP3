<?php
// app/Http/Controllers/MailController.php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'message' => 'required',
        ]);

        $recipientEmail = $request->input('recipient_email');
        $messageContent = $request->input('message');

        try {
            // Send the email
            Mail::to($recipientEmail)->send(new SendMail($messageContent));

            return redirect()->back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }
}
