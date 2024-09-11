import './bootstrap';
import { createApp } from 'vue';
import FileUpload from './components/FileUpload.vue';

const app = createApp({});
app.component('file-upload', FileUpload);
app.mount('#app');
