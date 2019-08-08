<template>
    <div>
        <dashboard-nav></dashboard-nav>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-2 d-none d-md-block bg-light side-nav sidebar">    
                    <ul class="nav flex-column">
                        <li v-for="client in clients" class="nav-item" v-bind:class="navClass(client.id)">
                            <a class="nav-link" @click="loadClientData(client.id)">
                                <span data-feather="home"></span> {{client.name}} <span class="sr-only"></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

                    <div class="row">
                        <div class="col-sm-12" style="text-align:right;">
                            <button @click="clearClient" class="btn btn-primary">NEW</button>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Name:</label>
                            <input class="form-control" v-bind:class="hasErrors('name')" v-model="client_name" />
                            <span class="form-control-error-block">{{getError('name')}}&nbsp;</span>
                            <br>
                            <br>
                            <label>Description:</label>
                            <textarea class="form-control" v-bind:class="hasErrors('description')" v-model="client_description">
                                {{client_description}}
                            </textarea>
                            <span class="form-control-error-block">{{getError('description')}}&nbsp;</span>
                            <br>
                        </div>
                        <div class="col-sm-6">
                            <label>Contact Name:</label>
                            <input class="form-control" v-bind:class="hasErrors('contact_name')" v-model="client_contact_name" />
                            <span class="form-control-error-block">{{getError('contact_name')}}&nbsp;</span>
                            <br>
                            <br>
                            <label>Contact Phone:</label>
                            <input class="form-control" v-bind:class="hasErrors('contact_phone')" v-model="client_contact_phone" />
                            <span class="form-control-error-block">{{getError('contact_phone')}}&nbsp;</span>
                            <br>
                            <br>
                            <label>Contact Email:</label>
                            <input type="email" class="form-control" v-bind:class="hasErrors('contact_email')" v-model="client_contact_email" />
                            <span class="form-control-error-block">{{getError('contact_email')}}&nbsp;</span>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12" style="text-align:right;">
                            <hr>
                            <button v-if="client_id" @click="update" class="btn btn-primary">UPDATE</button>
                            <button v-else @click="create" class="btn btn-primary">CREATE</button>
                        </div>
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
                client_id: '',
                client_name: '',
                client_description: '',
                client_contact_name: '',
                client_contact_phone: '',   
                client_contact_email: '',
                errors: [],
            };
        },

        methods: {

            getClients() {
                axios.get('/api/clients')
                .then(({data}) => {
                    this.clients = data;
                    this.errors = [];
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        window.location = "/login";
                    }
                });
            },

            loadClientData(client_id) {
                var t = this;

                this.errors = [];

                this.clients.forEach(function(client){
                    if(client.id == client_id) {
                        t.client = client;
                        t.client_id = client.id;
                        t.client_name = client.name;
                        t.client_description = client.description;
                        t.client_contact_name = client.contact_name;
                        t.client_contact_phone = client.contact_phone;   
                        t.client_contact_email = client.contact_email;
                    }
                });
            },

            update() {

                var data = {
                    name: this.client_name,
                    description: this.client_description,
                    contact_name: this.client_contact_name,
                    contact_phone: this.client_contact_phone,
                    contact_email: this.client_contact_email,
                    
                };

                axios.put('/api/clients/'+this.client_id, data)
                .then(({data}) => {
                    this.getClients();
                    this.errors = [];
                    // let user know it was successful
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        window.location = "/login";
                    }

                    // process other errors
                    if (response.status === 422) {
                        this.errors = response.data.errors;
                    }
                });
            },

            create() {
                var data = {
                    name: this.client_name,
                    description: this.client_description,
                    contact_name: this.client_contact_name,
                    contact_phone: this.client_contact_phone,
                    contact_email: this.client_contact_email,
                    
                };

                axios.post('/api/clients/', data)
                .then(({data}) => {
                    this.getClients();
                    this.errors = [];
                    // let user know it was successful
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        window.location = "/login";
                    }
                        
                    // process other errors
                    if (response.status === 422) {
                        this.errors = response.data.errors;
                    }
                        
                    
                });
            },

            clearClient() {
                this.errors = [];
                this.client = null;
                this.client_id = '';
                this.client_name = '';
                this.client_description = '';
                this.client_contact_name = '';
                this.client_contact_phone = '';
                this.client_contact_email = '';
            },

            navClass(id) {
                if(id == this.client_id) {
                    return 'selected';
                }

                return '';
            },

            hasErrors(column_name) {
                if(this.errors.hasOwnProperty(column_name)) {
                    return 'input-error';
                }

                return '';
            },

            getError(column_name) {
                if(this.errors.hasOwnProperty(column_name)) {
                    var errorString = '';
                    this.errors[column_name].forEach(function(error){
                        errorString += error;
                    });

                    return errorString;
                }

                return '';
            }
        },

        mounted() {
            console.log("mounted");
        },
        
        created() {
            this.getClients();
        },
        computed: {
            
        }

    }
</script>