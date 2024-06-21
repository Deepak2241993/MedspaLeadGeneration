{{-- resources/views/emails/your_template.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>Forever MedSpa Campain</h1>

    {{-- @if ($selectedTemplate)
        <p>Using selected template with ID: {{ $selectedTemplate }}</p>
    @endif --}}

    {!! $htmlCode !!} {{-- Use {!! !!} to display HTML content --}}
</body>
</html>
