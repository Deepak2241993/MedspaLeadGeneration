import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.pusherKey, // Define this in your Blade view
    cluster: window.pusherCluster, // Define this in your Blade view
    forceTLS: true,
});
