<template>
    <div class="row">
        <div class="col-md-4" v-for="product in products.data" :key="product.id">
            <div class="card" style="width: 20rem;">
                <img src="img/thumbnail.svg" class="card-img-top" style="height: 207px; object-fit: cover" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold" v-text="product.name"></h5>
                    <p class="card-text text-truncate" v-text="product.description"></p>
                    <a href="#" class="btn btn-primary mt-2">Ver más</a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4 md-4 text-right">
                Mostrando de {{products.from}} a {{products.to}} de {{products.total}} registros
            </div>
            <div class="col-1 md-1">
                <select class="form-control" v-model="pagination.per_page" @change="list();">
                    <option value="2">2</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="col-7 md-7">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" :class="{disabled:pagination.page==1}"><a href="#" class="page-link" @click="pagination.page=1; list();">&laquo;</a></li>
                        <li class="page-item" :class="{disabled:pagination.page==1}"><a href="#" class="page-link" @click="pagination.page--; list();">&lt;</a></li>
                        <li class="page-item" v-for="n in products.last_page" :key="n" :class="{active:pagination.page==n}"><a href="#" class="page-link" @click="pagination.page=n; list();">{{ n }}</a></li>
                        <li class="page-item" :class="{disabled:pagination.page==products.last_page}"><a href="#" class="page-link" @click="pagination.page++; list();">&gt;</a></li>
                        <li class="page-item" :class="{disabled:pagination.page==products.last_page}"><a href="#" class="page-link" @click="pagination.page=products.last_page; list();">&raquo;</a></li>
                    </ul>
                </nav>
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
                    per_page:2
                },
            }
        },
        methods : {
            async list(){
                let response = await axios.get('/showcase',{params: this.pagination});
                this.products = response.data;
            }
        },
        created() {
            this.list();
        }
    }
</script>
<style>

</style>
