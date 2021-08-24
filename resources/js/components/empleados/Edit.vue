<template>
    <div>
      <h1>Empleados Editar</h1>
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
            this.getDepartamentos();
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
            guardarEmpleado(){
                axios.post('/api/empleados', {
                    'apellido':this.form.apellido,
                    'nombre':this.form.nombre,
                    'nombre_medio':this.form.segundo_nombre,
                    'direccion':this.form.direccion,
                    'id_pais':this.form.id_pais,
                    'id_provincia':this.form.id_provincia,
                    'id_departamento':this.form.id_departamento,
                    'id_ciudad':this.form.id_ciudad,
                    'codigo_postal':this.form.codigo_postal,
                    'fecha_nacimiento':this.formatDate(this.form.fecha_nacimiento),
                    'fecha_contratacion':this.formatDate(this.form.fecha_contratacion),
                }).then(res => {
                    console.log(res);
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