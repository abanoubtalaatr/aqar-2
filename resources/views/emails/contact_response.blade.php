<!DOCTYPE html>
<html>
<head>
    <title>@lang('emails.response_title')</title>
</head>
<body>
    <p>@lang('emails.greeting', ['name' => $contact->user->name ?? __('emails.default_user')]),</p>
    
    <p>@lang('emails.thank_you_message')</p>

    <blockquote style="background:#f8f9fa; padding:10px; border-left:5px solid #007bff;">
        <strong>@lang('emails.your_message'):</strong> {{ $contact->message }}
    </blockquote>

    <p><strong>@lang('emails.our_response')</strong></p>
    <p>{{ $contact->response_message }}</p>

    <p>@lang('emails.best_regards'),</p>
    <p>@lang('emails.support_team')</p>
</body>
</html>
