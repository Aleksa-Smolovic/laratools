## Webscokets

Based on package: https://beyondco.de/docs/laravel-websockets/getting-started/installation.
Pusher is 3rd party service which runs on seperate server. 
This package replicates Pusher APIs so it can be used with all features relying on Pusher meaning it can used pusher package.
In the .env file, Pusher fields are user generated and are not real.
Client library used: Echo.
For pusher package run: ``composer require pusher/pusher-php-server "~4.0"``
For client app run: ``npm install --save laravel-echo pusher-js``

Package is built on top of Ratchet (low level php package: http://socketo.me/), which runs seperate server. Single server can be used for multiple apps (supports multi-tenancy).

## Flow

Running ``php artisan webscoket:serve`` start the server which mimics Pusher's server thus enabling usage of the functions and features relying on it (Broadcasting). Server can be configured and it support multiple apps connecting to it. 

To receive data client must be subscribed to appropriate channels. In this example, Echo is used to achieve this goal. 

Data can be sent to all users (non logged) using ``Channel`` or authenticated users using ``PrivateChannel`` and ``PresenceChannel``. 

Routes are protected in the ``routes/channels.php`` file. Custom logic can be provided for route protection as well as other means of auth (Bearer token, JWT, ...).

To send data to specific user, said user must be subscribed to unique channel. IE. channel name can contain user specific information like id and in route protection it can be checked wether authenticated user is subscribed to it's own channel thus preventing intrusion. Better use case would be to generate unique tokens on login and assign them to users.

## Events

Events are classes in which broadcast logic is defined for some app event: type of channel (channel, private or presence), channel (topic), input data, output data... 
Channels are used for events which are available to everyone.
PrivateChannels are used for events which are broadcast only to (authenticated) users or (custom) user groups.
PresenceChannels also require authorization.

Events can be customized by adding custom event name (used by echo, default is class name) or by defining output payload. Check Laravel Broadcasting documentation.

## Notes

- In this example standard Laravel auth logic is being used. Channel routes can be protected by other types of auth ie. Bearer token, jwt, etc.. For route protection and echo configuration check: https://stackoverflow.com/questions/41728930/laravel-broadcasting-auth-always-fails-with-403-error#answer-50405768
- TLS is acting weird (tls = false => http / ws, tls = true => https => wss)
- Sending to others except current user: 

    ``broadcast(new NewMessage($message))->toOthers();``

- Scenario: Creating comment for the post. It is faster to perform visual insert vith js than to wait websocket to insert it.
- IMPORTANT! Configure ``config/websockets.php`` before prod, ie. websocket stats insert level, period, tls, etc...

## Links

- BasePackage: https://beyondco.de/docs/laravel-websockets/getting-started/introduction
- Laravel Broadcasting: https://laravel.com/docs/7.x/broadcasting
- Ratchet (http://socketo.me/)
- Api token auth configuration: https://stackoverflow.com/questions/41728930/laravel-broadcasting-auth-always-fails-with-403-error#answer-50405768