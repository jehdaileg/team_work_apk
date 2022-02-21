import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";

import 'tailwindcss/tailwind.css';
import AppLayout from "./layouts/AppLayout.vue";

import Echo from "laravel-echo"

import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
});

window.Echo.channel('messageWelcome')
           .listen('MessageWelcomeEvent', (e)=> {
        console.log('Message received');
    });


const app = document.getElementById("app");

const pages = import.meta.glob("./pages/**/*.vue");

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: (name) => {
                const importPage = pages[`./pages/${name}.vue`];
                if (!importPage) {
                    throw new Error(
                        `Unknown page ${name}. Is it located under Pages with a .vue extension?`
                    );
                }

                return importPage().then((module) => {
                    const page = module.default;

                    if (!page.layout) page.layout = AppLayout;

                    return page;
                });
            },
        }),
})
    .use(InertiaPlugin)
    .mount(app);
