import { createApp } from 'vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';


const app = createApp({});

app.component('login-form', Login);
app.component('register-form', Register);


app.mount('#app');

