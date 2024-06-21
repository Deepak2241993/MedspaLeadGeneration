<!-- resources/views/make-call.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Make Call</title>
</head>
<body>
    <h1>Make a Call</h1>

    <form method="POST" action="{{ route('make-call') }}">
        @csrf
        <label for="recipient_number">Recipient Number:</label><br>
        <input type="text" id="recipient_number" name="recipient_number"><br><br>
        <button type="submit">Call</button>
    </form>
</body>
</html>
