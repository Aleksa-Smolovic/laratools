<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class FirebaseController extends Controller
{
    
    public function sendToToken(){
        $title = 'Ovo je title!';
        $body = 'Ovo je body!';
        $token = 'fWs_b_9HP-jN2HOOZPF3DF:APA91bHlmGt4ip0Lm8YJaUWwNYHInQpQmEZgN1YBYYxyZtEntQUickCVNJVaRjW5wvVYBCVNlSpxSYHximWTuNHrj2Hi2_0hAq8-rGejyjH3TRrYPASnq6VAmo0muJFymQuIhHKghtuP';
        return FirebaseService::sendToToken($title, $body, $token);
    }

    public function sendToTopic(){
        $title = 'Ovo je title!';
        $obj1 = new \stdClass; 
        $obj1->header = 'Header';
        $obj1->body = 'Body';
        $topic = 'alerts';
        return FirebaseService::sendToTopic($title, $obj1, $topic);
    }

    public function subscribeToTopic(){
        $token = 'fWs_b_9HP-jN2HOOZPF3DF:APA91bHlmGt4ip0Lm8YJaUWwNYHInQpQmEZgN1YBYYxyZtEntQUickCVNJVaRjW5wvVYBCVNlSpxSYHximWTuNHrj2Hi2_0hAq8-rGejyjH3TRrYPASnq6VAmo0muJFymQuIhHKghtuP';
        $topic = 'alerts';
        return FirebaseService::subscribe($token, $topic);
    }

    public function unsubscribeFromTopic(){
        $token = 'fWs_b_9HP-jN2HOOZPF3DF:APA91bHlmGt4ip0Lm8YJaUWwNYHInQpQmEZgN1YBYYxyZtEntQUickCVNJVaRjW5wvVYBCVNlSpxSYHximWTuNHrj2Hi2_0hAq8-rGejyjH3TRrYPASnq6VAmo0muJFymQuIhHKghtuP';
        $topic = 'alerts';
        return FirebaseService::unsubscribe($token, $topic);
    }


}
