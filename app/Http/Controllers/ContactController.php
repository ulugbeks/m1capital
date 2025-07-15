<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'site_type' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'post_code' => 'required|string|max:20',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
            'privacy' => 'required|accepted'
        ]);

        // Отправляем email
        $adminEmail = Setting::get('email', 'enquiries@energy-park.co.uk');
        
        Mail::send('emails.contact', $validated, function($message) use ($validated, $adminEmail) {
            $message->to($adminEmail)
                    ->subject('New Contact Form Submission')
                    ->replyTo($validated['email'], $validated['first_name'] . ' ' . $validated['last_name']);
        });

        return redirect()->back()->with('success', __('Thank you for your message. We will get back to you soon!'));
    }
}