<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Empleados
            </h1>
        </div>
            <div class="row">
                <div class="card mx-auto">
                    <div>
                        <div v-if="showMensaje" class="alert alert-success">
                            {{mensaje}}
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <input type="search" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Empleados">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <router-link :to="{name: 'EmpleadosCreate'}" class="btn btn-primary mb-2">Crear Empleado</router-link>
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="empleado in empleados" :key="empleado.id">
                                <th scope="row">#{{empleado.id}}</th>
                                <td>{{empleado.apellido}}</td>
                                <td>{{empleado.nombre}}</td>
                                <td>{{empleado.direccion}}</td>
                                <td>{{empleado.departamento}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <router-link :to="{name: 'EmpleadosEdit', params: {id:empleado.id}}" class="btn btn-success">Editar</router-link>
                                        </div>
                                        <div class="col">
                                                <button class="btn btn-danger" @click="borrarEmpleado(empleado.id)">Borrar</button>
                                        </div>
                                        
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><br>
    </div>
</template>

<script>
export default {
    data(){
        return {
            empleados: [],
            showMensaje: false,
            mensaje: ''
        }
    },
    created() {
        this.getEmpleados();
    },
    methods:{
        getEmpleados(){
            axios.get('/api/empleados')
            .then(res => {
                this.empleados = res.data.data;
            }).catch(error => {
                console.log(error);
            })
        },
        borrarEmpleado(id){
            axios.delete('/api/empleados/'+id)
            .then(res => {
                this.showMensaje = true
                this.mensaje = res.data;
                this.getEmpleados();
            }).catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>