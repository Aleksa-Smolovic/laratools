<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// This is fake route!
Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Because it has $user it isn't required anything else for auth check
// It will return 403 if $user is empty
// Additional configuration can be implemented. Check the code bellow. 
Broadcast::channel('application-event-{id}', function ($user, $id) {
    return true;
});


// Checking if auth user is subscribed to it's own channel.
Broadcast::channel('specific-user-event-{userId}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});