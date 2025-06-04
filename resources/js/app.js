import './bootstrap';
import { createApp } from 'vue';

// Import component
import TestComponent from './components/TestComponent.vue';

// Create Vue app
const app = createApp({});

// Register component
app.component('test-component', TestComponent);

// Mount app
app.mount('#app');
