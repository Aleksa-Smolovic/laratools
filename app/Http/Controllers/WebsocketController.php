<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PublicNotificationEvent;
use App\Events\UserNotificationEvent;
use App\Events\UserSpecificEvent;

class WebsocketController extends Controller
{
    
    public function sendPublicNotification(){
        event(new PublicNotificationEvent('Test data'));
    }

    public function sendAppUsersNotification(){
        event(new UserNotificationEvent(3));
    }

    public function sendSpecifiUserNotification(){
        event(new UserSpecificEvent(1));
    }

}
