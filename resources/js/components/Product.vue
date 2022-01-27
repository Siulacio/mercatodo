<template>
    <div class="container mt3">

        <div class="row">
            <div class="col-auto">
                <button @click=" modify=false; openModal();" type="button" class="btn btn-dark btn-sm" style="font-style: oblique">
                    Nuevo producto
                </button>
                <button @click="exportData();" type="button" class="btn btn-dark btn-sm" style="font-style: oblique">
                    Exportar productos
                </button>
            </div>
            <div class="col-4">
                &nbsp;
            </div>
            <div class="col-auto">
                <form id="frmImport" ref="frmImport" enctype="multipart/form-data">
                    <input type="file" name="file" id="file">
                    <button @click.prevent="uploadProducts();" type="submit" class="btn btn-dark btn-sm" style="font-style: oblique;">
                        Importar productos
                    </button>
                </form>
            </div>
        </div>
        <span class="text-danger" v-if="errors.file" v-text="errors.file[0]"></span>

        <table class="table table-hover mt-3">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Options</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td v-text="product.id"></td>
                    <td v-text="product.code"></td>
                    <td v-text="product.name"></td>
                    <td style="width: 40%" v-text="product.description"></td>
                    <td v-text="product.price"></td>
                    <td v-text="product.quantity"></td>
                    <td>
                        <button
                            @click="modify=true; openModal(product);"
                            class="btn btn-outline-primary btn-sm">
                            Editar
                        </button>
                        <button
                            @click="changeState(product.id)"
                            class="btn btn-sm"
                            :class="{'btn-outline-success':product.state, 'btn-outline-danger':!product.state }">
                            <span v-if="product.state">Activo</span>
                            <span v-else>Inactivo</span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!--modal-->
        <form id="frmProduct" ref="frmProduct" enctype="multipart/form-data">
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
                                        <label for="code">Código</label>
                                        <input v-model="product.code" type="text" class="form-control" id="code" name="code">
                                        <span class="text-danger" v-if="errors.code" v-text="errors.code[0]"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Nombre</label>
                                        <input v-model="product.name" type="text" class="form-control" id="name" name="name">
                                        <span class="text-danger" v-if="errors.name" v-text="errors.name[0]"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="price">Precio</label>
                                        <input v-model="product.price" type="text" class="form-control" id="price" name="price">
                                        <span class="text-danger" v-if="errors.price" v-text="errors.price[0]"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="quantity">Cantidad</label>
                                        <input v-model="product.quantity" type="text" class="form-control" id="quantity" name="quantity">
                                        <span class="text-danger" v-if="errors.quantity" v-text="errors.quantity[0]"></span>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="state">Estado</label>
                                        <select v-model="product.state" id="state" class="form-control" name="state">
                                            <option value="1" selected>Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                        <span class="text-danger" v-if="errors.state" v-text="errors.state[0]"></span>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="description">Descripción</label>
                                        <textarea v-model="product.description" class="form-control" id="description" name="description" cols="30" rows="4"></textarea>
                                        <span class="text-danger" v-if="errors.description" v-text="errors.description[0]"></span>
                                    </div>

                                    <label for="images" class="mt-3">Imágenes</label>
                                    <div class="col-md-10 mt-3" v-for="(input,k) in inputs" :key="k">
                                        <input type="file" name="images[]" id="images" class="custom-file-input" accept="image/">
                                        <span>
                                            <i style="font-weight: bold; color: #cb2626" @click.prevent="remove(k)" v-show="k || ( !k && inputs.length > 1)">Eliminar</i>
                                        </span>
                                    </div>

                                    <div class="col-md-2 mt-3">
                                        <button class="btn btn-outline-primary btn-sm" @click.prevent="add(k);">Añadir más</button>
                                    </div>

                                    <div v-for="(error, key) in errors" :key="key" class="mt-3"
                                         v-if="!errors.description & !errors.code & !errors.name & !errors.price & !errors.quantity & !errors.state">
                                        <hr/>
                                        <span class="text-danger" v-for="(errorItem, innerKey) in error" :key="innerKey" style="margin-top: 2rem">
                                            {{ errorItem }}
                                        </span>
                                    </div>

                                    <div v-if="modify" class="col-md-12 mt-3">
                                        <table width="50%">
                                            <tr v-for="image in images" :key="image.id">
                                                <td>
                                                    <img :src="'/storage/'+image.image"
                                                         :alt="image.name"
                                                         style="height: 50px; width: 50px; object-fit: cover">
                                                </td>
                                                <td v-text="image.name"></td>
                                                <td>
                                                    <span class="badge rounded-pill bg-danger" style="cursor: pointer" @click="deleteImage(image.id)">Eliminar</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button @click.prevent="store();" type="submit" class="btn btn-success" data-dismiss="modal">
                                <span v-if="modify">Actualizar</span>
                                <span v-else>Guardar</span>
                            </button>
                            <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                products:[],
                modalTitle:'',
                modalState:false,
                modify:true,
                product_id:0,
                product:{
                    code:'',
                    name:'',
                    description:'',
                    price:'',
                    quantity:'',
                    state:'',
                },
                errors:{},
                inputs:[
                    {
                        name:''
                    }
                ],
                k:0,
                images:[],
            }
        },
        methods: {
            async list() {
                let response = await axios.get('/products');
                this.products = response.data;
            },
            async changeState(id){
                await axios.get('/products/change_state/'+id);
                this.list();
            },
            openModal(data={}){
                this.modalState=true;
                if(this.modify === true){
                    this.modalTitle = 'Modificar Producto';
                    this.product_id = data.id;
                    this.product.code = data.code;
                    this.product.name = data.name;
                    this.product.description = data.description;
                    this.product.price = data.price;
                    this.product.quantity = data.quantity;
                    this.product.state = data.state;
                    this.listImages(this.product);
                }else{
                    this.modalTitle = 'Crear producto';
                    this.product_id = 0;
                    this.product.code = '';
                    this.product.name = '';
                    this.product.description = '';
                    this.product.price = '';
                    this.product.quantity = '';
                    this.product.state = '1';
                    this.images = [];
                }
            },
            closeModal(){
              this.modalState = false;
              this.errors={};
                this.$refs.frmProduct.reset();
                this.inputs = [{name:''}];
            },
            async store(){
                try {
                    let formFields = document.getElementById('frmProduct');
                    let product = new FormData(formFields);

                    if(this.modify){
                        let response = await axios.post('/products/update/' + this.product_id, product, {headers: {"Content-Type": "multipart/form-data"}});
                        this.successNotifier(response.data.message);
                    }else{
                        let response = await axios.post('/products', product, {headers: {"Content-Type": "multipart/form-data"}});
                        this.successNotifier(response.data.message);
                    }
                    this.closeModal();
                    this.list();
                }catch (error){
                    if(error.response.data){
                        this.errors = error.response.data.errors;
                    }
                }
            },
            add(index) {
                if(this.inputs.length < (5 - this.images.length)){
                    this.inputs.push({ name: '' });
                }
            },
            remove(index) {
                this.inputs.splice(index, 1);
            },
            async listImages(){
                let response = await axios.get('/products/images/'+this.product_id);
                this.images = response.data;
            },
            async deleteImage(id){
                let response = await axios.get('/products/images/delete/'+id);
                this.listImages();
                this.successNotifier(response.data.message);
            },
            async exportData(){
                let response = await axios.get('/products/export/excel');
                console.log(response.data);
                this.successNotifier(response.data.message);
            },
            async uploadProducts(){
                try {
                    let formFields = document.getElementById('frmImport');
                    let products = new FormData(formFields);
                    let response = await axios.post('/products/import/excel', products, {headers:{"Content-Type":"multipart/form-data"}});
                    this.list();
                    this.successNotifier(response.data.message);
                    this.$refs.frmImport.reset();
                }catch (error){
                    console.log(error);
                    if(error.response.data){
                        this.errors = error.response.data.errors;
                    }
                }
            },
            successNotifier(message){
                this.$toasted.success(message, {
                    duration:2000,
                    keepOnHover: true,
                });
            },
            errorNotifier(message){
                this.$toasted.error(message, {
                    duration:2000,
                    keepOnHover: true,
                });
            }
        },
        created() {
            this.list();
        }
    }
</script>
<style>
    .mostrar{
        display: list-item;
        opacity: 1;
        background: #1a202c;
    }
</style>
