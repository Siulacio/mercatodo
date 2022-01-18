<template>
    <div>
        <div class="row align-items-center mb-3">

            <div class="col-auto">
                <label class="col-form-label">Mostrando</label>
            </div>
            <div class="col-auto" style="width: 100px;">
                <select class="form-control" v-model="pagination.per_page" @change="list();">
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="col-auto">
                <label class="col-form-label">Registros</label>
            </div>
            <div class="col-6">
                &nbsp;
            </div>
            <div class="col-auto">
                <label class="col-form-label">Buscar:</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" v-model="pagination.search" @keyup="searchProducts">
            </div>

        </div>

        <div class="row">
            <div class="col-md-4" v-for="product in products.data" :key="product.id">
                <div class="card mb-3" style="width: 20rem;">
                    <div v-if="product.images.length > 0">
                        <img :src="'/storage/'+product.images[0].image"
                             class="card-img-top"
                             style="height: 207px; object-fit: cover">
                    </div>
                    <div v-else>
                        <img src="img/thumbnail.svg"
                             class="card-img-top"
                             style="height: 207px; object-fit: cover">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold" v-text="product.name"></h5>
                        <p class="card-text text-truncate" v-text="product.description"></p>
                        <a href="#" class="btn btn-primary mt-2">Ver más</a>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 md-6 text-left">
                    Mostrando de {{products.from}} a {{products.to}} de {{products.total}} registros
                </div>
                <div class="col-6 md-6 text-right">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" :class="{disabled:pagination.page==1}"><a href="#" class="page-link" @click="pagination.page=1; list();">&laquo;</a></li>
                            <li class="page-item" :class="{disabled:pagination.page==1}"><a href="#" class="page-link" @click="pagination.page--; list();">&lt;</a></li>
                            <li class="page-item" v-for="page in pages" :key="page" :class="{active:pagination.page==page}"><a href="#" class="page-link" @click="pagination.page=page; list();">{{ page }}</a></li>
                            <li class="page-item" :class="{disabled:pagination.page==products.last_page}"><a href="#" class="page-link" @click="pagination.page++; list();">&gt;</a></li>
                            <li class="page-item" :class="{disabled:pagination.page==products.last_page}"><a href="#" class="page-link" @click="pagination.page=products.last_page; list();">&raquo;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                products:[],
                pagination:{
                    page:1,
                    per_page:2,
                    search:'',
                },
                pages:[],
                setTimeOutSearch:'',
            }
        },
        methods : {
            async list(){
                let response = await axios.get('/showcase',{ params: this.pagination});
                this.products = response.data;
                this.listPages();
            },
            listPages(){
                const numberPages = 2;
                let arrayPages = [];
                let startPage = this.pagination.page - numberPages;
                let lastPage = this.pagination.page + numberPages;

                if (startPage < 1){
                    startPage = 1;
                }

                if (lastPage > this.products.last_page){
                    lastPage = this.products.last_page;
                }

                for (let i= startPage; i<=lastPage; i++){
                    arrayPages.push(i);
                }

                this.pages = arrayPages;
            },
            searchProducts(){
                clearTimeout(this.setTimeOutSearch);
                this.setTimeOutSearch = setTimeout(()=>this.list(), 500);
            }
        },
        created() {
            this.list();
        }
    }
</script>
<style>

</style>
