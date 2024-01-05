<!-- resources/views/send-mail.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="/send-mail" method="post">
        @csrf

        <label for="recipient_email">Recipient Email:</label>
        <input type="email" name="recipient_email" required>

        <br>

        <label for="message">Message:</label>
        <textarea name="message" required></textarea>

        <br>

        <button type="submit">Send Email</button>
    </form>

</body>
</html>
