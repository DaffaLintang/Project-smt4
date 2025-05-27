<<<<<<< HEAD
<x-guest-layout>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reset-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: red;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<div class="reset-container">
    <h2>Reset Password</h2>
>>>>>>> 349eb8f902e4e167584829958e965f4e12bcf4ba
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" readonly>
            @error('email')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            @error('password')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <p style="color: red; font-size: 12px;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Reset Password</button>
    </form>
</div>

</body>
</html>
