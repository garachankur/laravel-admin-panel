<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password.</h1>
    <p>Email: {{ $user->email }}</p>
    <a href="{{ url("admin/forgotpassword/".$user->token)}}"> click to reset your password</a>
</body>
</html>
