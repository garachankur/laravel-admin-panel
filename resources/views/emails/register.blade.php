<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
</head>
<body>
    @if($user->subscriptionstatus=="1")
    <h1>New Register Subscribe User</h1>
    @else
    <h1>New Register User</h1>
    @endif

    <table style="width:100%">
        <tr>
            <td>Email</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $user->name }}</td>
        </tr>

    </table>

</body>
</html>
