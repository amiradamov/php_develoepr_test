import './bootstrap';

import { createApp } from "vue/dist/vue.esm-bundler.js"
import Search from "./components/Search.vue"
const app = createApp({
    components: {
        Search,
    }
});

app.mount("#app");