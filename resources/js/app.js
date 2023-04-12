require("./bootstrap");

import { createApp } from "vue";
import App from "./vue/components/App";

const app = createApp({});

app.component("app", App);

app.mount("#app");
