<template>
    <div>
        <nav v-if="isApplicationRoute" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Teemo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <router-link to="/" class="nav-link">Home</router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/about" class="nav-link">About</router-link>
                </li>
                <li class="nav-item">
                  <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
                </li>
              </ul>
            </div>
        </nav>
        <div style="margin-top: 5rem">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                x: [],
            };
        },
        mounted() {
            console.log(this.$router.currentRoute.fullPath);
        },
        computed: {
            isApplicationRoute: function() {
                if(this.$route.path.indexOf('/about') >= 0 || this.$route.path.indexOf('/home') >= 0 || this.$route.path.indexOf('/login') >= 0 ) {
                    return true;
                }
                return false;
            }
        }
    }
</script>