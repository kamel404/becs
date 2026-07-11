<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333333; margin: 0; padding: 0; background-color: #f8fafc; }
        .container { max-width: 600px; margin: 20px auto; padding: 30px; background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        .header { border-bottom: 2px solid #3a7c79; padding-bottom: 15px; margin-bottom: 25px; }
        .header h2 { margin: 0; color: #1a202c; }
        .header span { color: #3a7c79; font-weight: bold; }
        .field { margin-bottom: 15px; }
        .field label { display: block; font-weight: bold; color: #4a5568; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 4px; }
        .field div { background-color: #f7fafc; padding: 12px; border-radius: 4px; border: 1px solid #edf2f7; font-size: 0.95rem; }
        .message-content { white-space: pre-line; }
        .footer { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e2e8f0; font-size: 0.75rem; color: #718096; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Inquiry from <span>{{ $inquiry['name'] }}</span></h2>
        </div>

        <div class="field">
            <label>Name</label>
            <div>{{ $inquiry['name'] }}</div>
        </div>

        <div class="field">
            <label>Email Address</label>
            <div><a href="mailto:{{ $inquiry['email'] }}">{{ $inquiry['email'] }}</a></div>
        </div>

        @if(!empty($inquiry['phone']))
        <div class="field">
            <label>Phone Number</label>
            <div>{{ $inquiry['phone'] }}</div>
        </div>
        @endif

        <div class="field">
            <label>Required Service</label>
            <div>{{ ucwords($inquiry['service'] ?? 'General Inquiry') }}</div>
        </div>

        <div class="field">
            <label>Message</label>
            <div class="message-content">{{ $inquiry['message'] }}</div>
        </div>

        <div class="footer">
            This email was sent dynamically from the BECS website contact form.
        </div>
    </div>
</body>
</html>
