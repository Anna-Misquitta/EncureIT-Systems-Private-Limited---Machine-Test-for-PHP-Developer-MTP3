<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Test Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .success-message {
            color: #4caf50;
            margin-top: 10px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class='form-container'>
        @if(session('success'))
        <p class="success-message">
        <p>
            Data saved successfully (Execution time:
            {{ session('success')['execution_time'] }} seconds)
        </p>
        <p>
            <strong>IP Address:</strong>
            {{session('success')['ip_address']}}
        </p>
        <p>
            <strong>City:</strong>
            {{session('success')['city']}}
        </p>
        <p>
            <strong>State:</strong>
            {{session('success')['state']}}
        </p>
        </p>
        @endif
        <form action="{{ route('saveData') }}" method="post">
            @csrf
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>
            <br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>
            <br>
            <button type="submit">Save</button>
        </form>
    </div>
</body>

</html>