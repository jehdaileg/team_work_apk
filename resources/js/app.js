import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";

import 'tailwindcss/tailwind.css';
import AppLayout from "./layouts/AppLayout.vue";

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
