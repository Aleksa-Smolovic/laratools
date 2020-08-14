## Firebase Cloud Messaging

- Add `FIREBASE_SERVER_URL` and `FIREBASE_SERVER_KEY` to the .env file.
- Run `composer update`, `composer dump-autoload` for registered namespace
- Implement service class `use App\Services\FirebaseService;`
- Available functions:
    - `FirebaseService::sendToTopic($title, $body, $topic);`
    - `FirebaseService::sendToToken($title, $body, $token);`
    - `FirebaseService::subscribe($token, $topic);`
    - `FirebaseService::unsubscribe($token, $topic);`
- Notification body can be modified to support click_action, icon, and other options