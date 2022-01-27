<template>
    <div>
        <form id="frmProductsReport" ref="frmProductsReport">
            <div class="row">
                <div class="col-2">
                    <label for="state">Estado producto: </label>
                    <select name="state" id="state" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="fecha_inicial">fecha inicial</label>
                    <input type="date" name="fecha_inicial" id="fecha_inicial" required class="form-control">
                </div>
                <div class="col-2">
                    <label for="fecha_final">fecha final</label>
                    <input type="date" name="fecha_final" id="fecha_final" required class="form-control">
                </div>
                <div class="col-4">
                    <br>
                    <button @click.prevent="generateReport();" type="submit" class="btn btn-dark btn-sm" style="font-style: oblique;">Exportar</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span class="text-danger" v-if="errors.state" v-text="errors.state[0]"></span>
                    <br>
                    <span class="text-danger" v-if="errors.fecha_inicial" v-text="errors.fecha_inicial[0]"><br></span>
                    <br>
                    <span class="text-danger" v-if="errors.fecha_final" v-text="errors.fecha_final[0]"></span>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                errors : {},
            }
        },
        methods : {
            async generateReport(){
                try {
                    let formFields = document.getElementById('frmProductsReport');
                    let products = new FormData(formFields);
                    let response = await axios.post('/reports/products', products);
                }catch (error){
                    if(error.response.data){
                        this.errors = error.response.data.errors;
                    }
                }

            }
        }
    }
</script>
