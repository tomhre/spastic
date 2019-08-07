<template>
    <div>
        <dashboard-nav></dashboard-nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li v-for="client in clients" class="nav-item">
                                <a class="nav-link" @click="loadClientData(client.id)">
                                    <span data-feather="home"></span> {{client.name}} <span class="sr-only"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div v-if="client != null" class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2"></h1>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                clients: [],
                client: null,
            };
        },

        methods: {

            getClients() {
                axios.get('/api/clients')
                .then(({data}) => {
                    this.clients = data;
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        window.location = "/login";
                    }
                });
            },

            loadClientData(client_id) {
                this.client = {name:'client1', id: 1}
            }
        },

        mounted() {
            console.log("mounted");
        },
        
        created() {
            this.getClients();
        },

    }
</script>