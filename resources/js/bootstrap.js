import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';

window.Pusher = Pusher;

// 🔴 FORCE axios to send cookies
axios.defaults.withCredentials = true;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,

    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,

   
    authEndpoint: '/broadcasting/auth',

   
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    },
});
