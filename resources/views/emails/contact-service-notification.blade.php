<!DOCTYPE html>
<html>
<head>
    <title>New Contact Service Request</title>
</head>
<body>
    <h1>New Contact Service Request</h1>
    
    <p>A new contact service request has been submitted:</p>
    
    <ul>
        <li>User ID: {{ $contact->user_id }}</li>
        <li>Service Type ID: {{ $contact->service_type_id }}</li>
        <li>Message: {{ $contact->message }}</li>
        <li>Share With: {{ $contact->share_with ? 'Yes' : 'No' }}</li>
    </ul>
    
    <p>Please review and take appropriate action.</p>
</body>
</html>