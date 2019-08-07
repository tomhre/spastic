<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <router-link to="/dashboard" class="navbar-brand">Teemo</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                    <!--
                    <li class="nav-item active">
                        <router-link to="/reports" class="nav-link">Reports</router-link>
                    </li>
                    -->
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img :src="user.photo_url" class="photo-circle m-r-xs">
                            <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-header">Management</li>
                            <div class="dropdown-divider"></div>
                            <router-link class="dropdown-item" to="/clients">Clients</router-link>
                            <a class="dropdown-item" href="#">Projects</a>
                            <a class="dropdown-item" href="/tasks">Tasks</a>
                            <div class="dropdown-divider"></div>
                            <li class="dropdown-header">Administration</li>
                            <a class="dropdown-item" href="/tasks">Tasks</a>
                            <div class="dropdown-divider"></div>
                            <router-link class="dropdown-item" v-if="authenticated && user" @click.native="logout" to="/logout">Logout</router-link>
                            <router-link class="dropdown-item" to="/login" v-else>Login</router-link>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
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
    }
</script>

