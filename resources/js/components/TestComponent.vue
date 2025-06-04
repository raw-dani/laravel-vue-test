<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Laravel + Vue.js Test Application</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h5>Server Info:</h5>
                    <p><strong>Laravel Version:</strong> {{ serverInfo.laravel_version }}</p>
                    <p><strong>PHP Version:</strong> {{ serverInfo.php_version }}</p>
                    <p><strong>Server Time:</strong> {{ serverInfo.server_time }}</p>
                </div>
                
                <div class="mb-3">
                    <h5>Vue.js Test:</h5>
                    <input 
                        v-model="message" 
                        type="text" 
                        class="form-control mb-2"
                        placeholder="Type something..."
                    >
                    <p><strong>You typed:</strong> {{ message }}</p>
                </div>

                <div class="mb-3">
                    <h5>API Test:</h5>
                    <button @click="testApi" class="btn btn-primary" :disabled="loading">
                        {{ loading ? 'Loading...' : 'Test API Connection' }}
                    </button>
                    <div v-if="apiResponse" class="mt-2 alert alert-success">
                        <strong>API Response:</strong> {{ apiResponse }}
                    </div>
                </div>

                <div class="mb-3">
                    <h5>Database Test:</h5>
                    <button @click="testDatabase" class="btn btn-secondary" :disabled="dbLoading">
                        {{ dbLoading ? 'Loading...' : 'Test Database Connection' }}
                    </button>
                    <div v-if="dbResponse" class="mt-2 alert" :class="dbResponse.success ? 'alert-success' : 'alert-danger'">
                        <strong>Database Status:</strong> {{ dbResponse.message }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'TestComponent',
    data() {
        return {
            message: 'Hello from Vue.js!',
            serverInfo: {},
            apiResponse: null,
            dbResponse: null,
            loading: false,
            dbLoading: false
        }
    },
    mounted() {
        this.getServerInfo();
    },
    methods: {
        async getServerInfo() {
            try {
                const response = await axios.get('/api/server-info');
                this.serverInfo = response.data;
            } catch (error) {
                console.error('Error fetching server info:', error);
            }
        },
        async testApi() {
            this.loading = true;
            try {
                const response = await axios.get('/api/test');
                this.apiResponse = response.data.message;
            } catch (error) {
                this.apiResponse = 'API Error: ' + error.message;
            }
            this.loading = false;
        },
        async testDatabase() {
            this.dbLoading = true;
            try {
                const response = await axios.get('/api/test-database');
                this.dbResponse = response.data;
            } catch (error) {
                this.dbResponse = {
                    success: false,
                    message: 'Database Error: ' + error.message
                };
            }
            this.dbLoading = false;
        }
    }
}
</script>
