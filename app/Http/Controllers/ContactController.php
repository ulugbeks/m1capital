<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        Log::info('Contact form submission started', ['request_data' => $request->all()]);
        
        try {
            // Validate the form data
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'telephone' => 'nullable|string|max:50',
                'telephone_full' => 'nullable|string|max:50',
                'message' => 'nullable|string|max:1000',
                'privacy' => 'required|accepted'
            ]);
            
            // Use full phone number if available, otherwise use regular telephone field
            if (!empty($validated['telephone_full'])) {
                $validated['telephone'] = $validated['telephone_full'];
            } elseif (!empty($validated['telephone']) && !str_starts_with($validated['telephone'], '+')) {
                // If phone number doesn't have country code, add a note
                $validated['telephone'] = $validated['telephone'] . ' (country code not provided)';
            }
            unset($validated['telephone_full']); // Remove from data sent to email
            
            Log::info('Phone number to be sent:', ['phone' => $validated['telephone']]);
            
            Log::info('Validation passed', ['validated_data' => $validated]);

            // Get recipient email
            $recipient = env('MAIL_TO_ADDRESS', env('MAIL_FROM_ADDRESS'));
            Log::info('Sending email to: ' . $recipient);
            
            // Send email
            Mail::to($recipient)->send(new ContactFormMail($validated));
            
            Log::info('Email sent successfully');

            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for contacting us! We will get back to you soon.'
                ]);
            }

            // Return success response for regular form submission
            return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                    'message' => 'Please correct the errors in the form.'
                ], 422);
            }
            
            throw $e;
        } catch (\Exception $e) {
            // Log the error with full details
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again later.'
                ], 500);
            }
            
            // For debugging - remove this in production
            if (config('app.debug')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error: ' . $e->getMessage() . ' (Line: ' . $e->getLine() . ')');
            }
            
            // Return error response
            return redirect()->back()
                ->withInput()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }
}