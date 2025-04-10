<!DOCTYPE html>
<html>
<head>
    <title>New Notice</title>
</head>
<body>
    <h2>{{ $notice->title }}</h2>
    <p>{{ $notice->content }}</p>

    @if($notice->expires_at)
        <p><strong>Expires on:</strong> {{ \Carbon\Carbon::parse($notice->expires_at)->format('M d, Y') }}</p>
    @endif

    <p>Regards,<br/>Society Management Team</p>
</body>
</html>
