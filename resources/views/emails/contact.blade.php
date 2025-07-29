<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        .value {
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 3px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Contact Form Submission</h2>
    </div>
    
    <div class="content">
        <p>You have received a new contact form submission with the following details:</p>
        
        <div class="field">
            <span class="label">Name:</span>
            <div class="value">{{ $data['first_name'] }} {{ $data['last_name'] }}</div>
        </div>
        
        @if(!empty($data['company']))
        <div class="field">
            <span class="label">Company:</span>
            <div class="value">{{ $data['company'] }}</div>
        </div>
        @endif
        
        <div class="field">
            <span class="label">Email:</span>
            <div class="value">
                <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
            </div>
        </div>
        
        @if(!empty($data['telephone']))
        <div class="field">
            <span class="label">Telephone:</span>
            <div class="value">
                {{ $data['telephone'] }}
                
            </div>
        </div>
        @endif
        
        @if(isset($data['message']) && !empty($data['message']))
        <div class="field">
            <span class="label">Message:</span>
            <div class="value">{{ $data['message'] }}</div>
        </div>
        @endif
        
        <div class="footer">
            <p>This email was sent from the M1capital.eu website contact form.</p>
            <p>Date: {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>