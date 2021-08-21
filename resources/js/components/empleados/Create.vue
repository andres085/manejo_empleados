<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Crear Empleado
            </h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                                    Crear Empleado
                                    <router-link :to="{name:'EmpleadosIndex'}" class="btn btn-primary mb-2 float-right">Volver</router-link> 
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>

                                    <div class="col-md-6">
                                        <input id="apellido" type="text" class="form-control" name="apellido" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control" name="nombre" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="segundo_nombre" class="col-md-4 col-form-label text-md-right">Segundo Nombre</label>

                                    <div class="col-md-6">
                                        <input id="segundo_nombre" type="text" class="form-control" name="segundo_nombre" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="direccion" class="col-md-4 col-form-label text-md-right">Dirección</label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text" class="form-control" name="direccion" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pais" class="col-md-4 col-form-label text-md-right">País</label>

                                    <div class="col-md-6">
                                        <select name="id_pais" class="form-control" aria-label="Default select example" v-model="form.id_pais" @change="getProvincias()">
                                            <option value="">Selecciona un Pais</option>
                                            <option v-for="pais in paises" :key="pais.id" :value="pais.id">{{pais.nombre}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                         <label for="provincia" class="col-md-4 col-form-label text-md-right">Provincia</label>

                                    <div class="col-md-6">
                                        <select name="id_provincia" class="form-control" aria-label="Default select example">
                                            <option selected>Selecciona una Provincia</option>
                                                <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_departamento" class="col-md-4 col-form-label text-md-right">Departamento</label>

                                    <div class="col-md-6">
                                        <select name="id_departamento" class="form-control" aria-label="Default select example">
                                            <option selected>Selecciona un Departamento</option>
                                                <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                     <div class="form-group row">
                                    <label for="id_ciudad" class="col-md-4 col-form-label text-md-right">Ciudad</label>

                                    <div class="col-md-6">
                                        <select name="id_ciudad" class="form-control" aria-label="Default select example">
                                            <option selected>Selecciona una Ciudad</option>
                                                <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="codigo_postal" class="col-md-4 col-form-label text-md-right">Codigo Postal</label>

                                    <div class="col-md-6">
                                        <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento</label>

                                    <div class="col-md-6">
                                        <datepicker id="fecha_nacimiento" input-class="form-control"></datepicker>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="fecha_contratacion" class="col-md-4 col-form-label text-md-right">Fecha de Contratación</label>

                                    <div class="col-md-6">
                                         <datepicker id="fecha_contratacion" input-class="form-control"></datepicker>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Crear
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            Datepicker
        },
        data(){
            return{
                paises:[],
                provincias: [],
                departamentos: [],
                ciudades: [],
                form: {
                    apellido: "",
                    nombre: "",
                    segundo_nombre: "",
                    direccion: "",
                    id_pais: "",
                    id_provincia: "",
                    id_departamento: "",
                    id_ciudad: "",
                    codigo_postal: "",
                    fecha_nacimiento: null,
                    fecha_contratacion: null
                }
            }
        },
        created(){
            this.getPaises();
        },
        methods: {
            getPaises(){
                axios.get('/api/empleados/paises')
                    .then(res => {
                        this.paises = res.data;
                    }).catch(error => {
                        console.log(error);
                    });
            },
            getProvincias(){
                axios.get('/api/empleados/'+ this.form.id_pais + "/provincias")
                    .then(res => {
                        this.provincias = res.data;
                    }).catch(error => {
                        console.log(error);
                    });
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>