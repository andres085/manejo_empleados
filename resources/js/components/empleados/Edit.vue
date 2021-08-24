<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                                    Actualizar Empleado
                                    <router-link :to="{name:'EmpleadosIndex'}" class="btn btn-primary mb-2 float-right">Volver</router-link> 
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="actualizarEmpleado()">
                                <div class="form-group row">
                                    <label for="apellido" class="col-md-4 col-form-label text-md-right">Apellido</label>

                                    <div class="col-md-6">
                                        <input id="apellido" type="text" class="form-control" name="apellido" value="" v-model="form.apellido">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>

                                    <div class="col-md-6">
                                        <input id="nombre" type="text" class="form-control" name="nombre" value="" v-model="form.nombre">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="segundo_nombre" class="col-md-4 col-form-label text-md-right">Segundo Nombre</label>

                                    <div class="col-md-6">
                                        <input id="segundo_nombre" type="text" class="form-control" name="segundo_nombre" value="" v-model="form.nombre_medio">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="direccion" class="col-md-4 col-form-label text-md-right">Dirección</label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text" class="form-control" name="direccion" value="" v-model="form.direccion">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pais" class="col-md-4 col-form-label text-md-right">País</label>

                                    <div class="col-md-6">
                                        <select name="id_pais" class="form-control" aria-label="Default select example" v-model="form.id_pais" @change="getProvincias()">
                                            <option v-for="pais in paises" :key="pais.id" :value="pais.id">{{pais.nombre}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                         <label for="provincia" class="col-md-4 col-form-label text-md-right">Provincia</label>

                                    <div class="col-md-6">
                                        <select name="id_provincia" class="form-control" aria-label="Default select example" v-model="form.id_provincia" @change="getCiudades()">
                                                <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">{{provincia.nombre}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_departamento" class="col-md-4 col-form-label text-md-right">Departamento</label>

                                    <div class="col-md-6">
                                        <select name="id_departamento" class="form-control" aria-label="Default select example" v-model="form.id_departamento">
                                                <option v-for="departamento in departamentos" :key="departamento.id" :value="departamento.id">{{departamento.nombre}}</option>
                                        </select>
                                    </div>
                                </div>

                                     <div class="form-group row">
                                    <label for="id_ciudad" class="col-md-4 col-form-label text-md-right">Ciudad</label>

                                    <div class="col-md-6">
                                        <select name="id_ciudad" class="form-control" aria-label="Default select example" v-model="form.id_ciudad">
                                                <option v-for="ciudad in ciudades" :key="ciudad.id" :value="ciudad.id">{{ ciudad.nombre }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="codigo_postal" class="col-md-4 col-form-label text-md-right">Codigo Postal</label>

                                    <div class="col-md-6">
                                        <input id="codigo_postal" type="text" class="form-control" name="codigo_postal" value="" v-model="form.codigo_postal">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fecha_nacimiento" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento</label>

                                    <div class="col-md-6">
                                        <datepicker id="fecha_nacimiento" input-class="form-control" v-model="form.fecha_nacimiento"></datepicker>
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="fecha_contratacion" class="col-md-4 col-form-label text-md-right">Fecha de Contratación</label>

                                    <div class="col-md-6">
                                         <datepicker id="fecha_contratacion" input-class="form-control" v-model="form.fecha_contratacion"></datepicker>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Actualizar
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
import moment from 'moment';
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
                    nombre_medio: "",
                    direccion: "",
                    id_pais: "",
                    id_provincia: "",
                    id_departamento: "",
                    id_ciudad: "",
                    codigo_postal: "",
                    fecha_nacimiento: null,
                    fecha_contratacion: null
                },
            }
        },
        created(){
            this.getPaises();
            this.getDepartamentos();
            this.getEmpleado();
        },
        methods: {
            getEmpleado(){
                  axios.get('/api/empleados/'+ this.$route.params.id)
                    .then(res => {
                        this.form = res.data.data;
                        this.getProvincias();
                        this.getCiudades();
                    }).catch(error => {
                        console.log(error);
                    });
            },
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
            getCiudades(){
                axios.get('/api/empleados/'+ this.form.id_provincia + "/ciudades")
                    .then(res => {
                        this.ciudades = res.data;
                    }).catch(error => {
                        console.log(error);
                    });
            },
            getDepartamentos(){
                axios.get('/api/empleados/departamentos')
                    .then(res => {
                        this.departamentos = res.data;
                    }).catch(error => {
                        console.log(error);
                    });
            },
            actualizarEmpleado(){
                axios.put('/api/empleados/' + this.$route.params.id, {
                    'apellido':this.form.apellido,
                    'nombre':this.form.nombre,
                    'nombre_medio':this.form.nombre_medio,
                    'direccion':this.form.direccion,
                    'id_pais':this.form.id_pais,
                    'id_provincia':this.form.id_provincia,
                    'id_departamento':this.form.id_departamento,
                    'id_ciudad':this.form.id_ciudad,
                    'codigo_postal':this.form.codigo_postal,
                    'fecha_nacimiento':this.formatDate(this.form.fecha_nacimiento),
                    'fecha_contratacion':this.formatDate(this.form.fecha_contratacion),
                }).then(res => {
                    this.$router.push({name: 'EmpleadosIndex'});
                })
            },
            formatDate(date){
                if(date){
                    return moment(String(date)).format('YYYYMMDD');
                }
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>