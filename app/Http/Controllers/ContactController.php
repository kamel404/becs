<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use App\Mail\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store contact inquiry and send email.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'service' => 'required|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->all()
            ], 422);
        }

        $validatedData = $request->only(['name', 'email', 'phone', 'service', 'message']);

        // Save to DB
        ContactMessage::create([
            'name'    => $validatedData['name'],
            'email'   => $validatedData['email'],
            'phone'   => $validatedData['phone'] ?? null,
            'subject' => 'Service Inquiry: ' . ucwords($validatedData['service']),
            'message' => $validatedData['message'],
        ]);

        // Send Email
        try {
            $toEmail = Setting::get('contact_email', 'info@becs.com.lb');
            Mail::to($toEmail)->send(new ContactInquiry($validatedData));
        } catch (\Exception $e) {
            // Log the error but proceed so the database save isn't lost
            logger()->error('Failed to send contact inquiry email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!'
        ]);
    }
}
