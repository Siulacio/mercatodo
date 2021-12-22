<template>
    <div class="container mt-3">
        <h1 class="text-center">Gestión Usuarios</h1>
        <button @click=" modify=false; openModal();" type="button" class="btn btn-dark btn-sm" style="font-style: oblique">
            Nuevo Usuario
        </button>

        <table class="table table-hover mt-3">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Address</th>
                <th scope="col">Email</th>
                <th scope="col">Options</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td v-text="user.id"></td>
                <td v-text="user.name"></td>
                <td v-text="user.last_name"></td>
                <td v-text="user.address"></td>
                <td v-text="user.email"></td>
                <td>
                    <button
                        @click="modify=true; openModal(user);"
                        class="btn btn-outline-primary btn-sm">
                        Editar
                    </button>
                    <button
                        @click="changeState(user.id)"
                        class="btn btn-sm"
                        :class="{'btn-outline-success':user.state, 'btn-outline-danger':!user.state }">
                        <span v-if="user.state">Activo</span>
                        <span v-else>Inactivo</span>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="modal" :class="{mostrar:modalState}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="modalTitle"></h4>
                        <button @click="closeModal();" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Name</label>
                                    <input v-model="user.name" type="text" class="form-control" id="name">
                                    <span class="text-danger" v-if="errors.name" v-text="errors.name[0]"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name">Last name</label>
                                    <input v-model="user.last_name" type="text" class="form-control" id="last_name">
                                    <span class="text-danger" v-if="errors.last_name" v-text="errors.last_name[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="identification">Identification</label>
                                    <input v-model="user.identification" type="text" class="form-control" id="identification">
                                    <span class="text-danger" v-if="errors.identification" v-text="errors.identification[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address">Address</label>
                                    <input v-model="user.address" type="text" class="form-control" id="address">
                                    <span class="text-danger" v-if="errors.address" v-text="errors.address[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phone">Phone</label>
                                    <input v-model="user.phone" type="text" class="form-control" id="phone">
                                    <span class="text-danger" v-if="errors.phone" v-text="errors.phone[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="email">Email</label>
                                    <input v-model="user.email" type="text" class="form-control" id="email">
                                    <span class="text-danger" v-if="errors.email" v-text="errors.email[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="role">Role</label>
                                    <select v-model="user.role" id="role" class="form-control">
                                        <option value="standar" selected>Standar</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.role" v-text="errors.role[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="state">State</label>
                                    <select v-model="user.state" id="state" class="form-control">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.state" v-text="errors.state[0]"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="password">Password</label>
                                    <input v-model="user.password" type="password" id="password" class="form-control">
                                    <span class="text-danger" v-if="errors.password" v-text="errors.password[0]"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button @click="store();" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                        <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return{
                users:[],
                modalTitle:'',
                modalState:false,
                modify: true,
                user_id:0,
                user:{
                    name:'',
                    last_name:'',
                    identification:'',
                    address:'',
                    phone:'',
                    role:'',
                    state:'',
                    email:'',
                    password:'',
                },
                errors:{},
            }
        },
        methods: {
            async list(){
                let response = await axios.get('/users');
                this.users = response.data;
            },
            async changeState(id){
                await axios.get('/users/change_state/'+id);
                this.list();
            },
            openModal(data={}){
                this.modalState = true;
                if(this.modify === true){
                    this.modalTitle = 'Modificar Usuario';
                    this.user_id = data.id;
                    this.user.name = data.name;
                    this.user.last_name = data.last_name;
                    this.user.identification = data.identification;
                    this.user.address = data.address;
                    this.user.phone = data.phone;
                    this.user.role = data.role;
                    this.user.state = data.state;
                    this.user.email = data.email;
                    this.user.password = data.password;
                }else{
                    this.modalTitle = 'Crear Usuario';
                    this.user_id = 0;
                    this.user.name = '';
                    this.user.last_name = '';
                    this.user.identification = '';
                    this.user.address = '';
                    this.user.phone = '';
                    this.user.role = 'standar';
                    this.user.state = '1';
                    this.user.email = '';
                    this.user.password = '';
                }
            },
            closeModal(){
                this.modalState = false;
                this.errors={};
            },
            async store(){
                try {
                    if(this.modify){
                        let response = await axios.put('/users/' + this.user_id, this.user);
                    }else{
                        let response = await axios.post('/users', this.user);
                    }
                    this.closeModal();
                    this.list();
                }catch (error){
                    if(error.response.data){
                        this.errors = error.response.data.errors;
                    }
                }
            },
        },
        created() {
            this.list();
        },
    }
</script>
<style>
    .mostrar{
        display: list-item;
        opacity: 1;
        background: #1a202c;
    }
</style>
