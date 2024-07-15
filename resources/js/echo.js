import Echo from 'laravel-echo';
 
import Pusher from 'pusher-js';
window.Pusher = Pusher;
 
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_APP_HOST,
    wsPort: import.meta.env.VITE_REVERB_APP_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_APP_PORT ?? 443,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: false,
    enabledTransports: ['ws', 'wss']
});