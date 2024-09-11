import './bootstrap';
import { createApp } from 'vue';
import FileUpload from './components/FileUpload.vue';

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

const app = createApp({});
app.component('file-upload', FileUpload);
app.mount('#app');
