<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FirebaseService{

    public static function sendToTopic($title, $body, $topic){
       return self::sendNotification(self::createBasicNotification($title, $body, '/topics/' . $topic));
    }

    public static function sendToToken($title, $body, $token){
        return self::sendNotification(self::createBasicNotification($title, $body, '/token/' . $token));
    }

    public static function subscribe($token, $topic){
       return self::subscriptionManagement($token, $topic, true);
    }

    public static function unsubscribe($token, $topic){
        return self::subscriptionManagement($token, $topic, false);
    }

    #batch: https://developers.google.com/instance-id/reference/server#manage_relationship_maps_for_multiple_app_instances
    private static function subscriptionManagement($token, $topic, $isSubscribe){
        $url = 'https://iid.googleapis.com/iid/v1/' . $token . '/rel/topics/' . $topic;
        $headers = [
            'Authorization' => 'key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type:' => 'application/json'
        ];
        $response = ($isSubscribe) ? Http::withHeaders($headers)->post($url) : Http::withHeaders($headers)->delete($url);
        return $response->successful();
    }

    #can be extended with more options: click_action, icon...
    private static function createBasicNotification($title, $body, $to){
        $notification = [
            'title' => $title,
            'body' => $body,
            'alert' => 'Test Push Message',
            'sound' => 'default',
        ];
        $data = [
            'title' => $title,
            'body' => $body,
            'priority' => 'high',
            'content_available' => true
        ];

        $notificationBody = [
            'to' => $to,
            'notification' => $notification,
            'data' => $data,
            'priority' => 10
        ];

        return $notificationBody;
    }

    private static function sendNotification($notification){
        $headers = [
            'Authorization' => 'key=' . env('FIREBASE_SERVER_KEY'),
            'Content-Type:' => 'application/json'
        ];
        $response = Http::withHeaders($headers)->post(env('FIREBASE_SERVER_URL'), $notification);
        return $response->successful();
    }

}