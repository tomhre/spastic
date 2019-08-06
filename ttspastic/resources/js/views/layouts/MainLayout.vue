<template>
    <div>
        <div>
            <router-link to="/">Home</router-link>
            <router-link to="/about">About</router-link>
            <router-link to="/dashboard">Dashboard</router-link>
        </div>

        <div>
            <div v-if="authenticated && user">
                <p>Hello, {{ user.name }}</p>
                <router-link @click.native="logout" to="/logout">Logout</router-link>
            </div>

            <router-link to="/login" v-else>Login</router-link>
        </div>

        <div style="margin-top: 2rem">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                authenticated: auth.check(),
                user: auth.user
            };
        },

        methods: {
            logout() {
                console.log("logout");
                axios.post('/api/logout')
                .then(({data}) => {
                    auth.logout();
                    this.user = null;
                    this.$router.push('/home');
                })  
                .catch(({response}) => {                    
                    alert(response.data.message);
                });
            }
        },

        mounted() {
            Event.$on('userLoggedIn', () => {
                this.authenticated = true;
                this.user = auth.user;
            });
        },
    }
</script>