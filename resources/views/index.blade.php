<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    

    <script src="{{asset('js/app.js')}}"></script>
    <script>
        Echo.channel('public-notifications')
            .listen('PublicNotificationEvent', (e) => {
                console.log(e.notification);
            });
    </script>
</body>
</html>