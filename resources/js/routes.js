import EmpleadosIndex from './components/empleados/Index.vue';
import EmpleadosCreate from './components/empleados/Create.vue';
import EmpleadosEdit from './components/empleados/Edit.vue';

export const routes = [
    {
        path: '/empleados',
        name: 'EmpleadosIndex',
        component: EmpleadosIndex
    },
    {
        path: '/empleados/create',
        name: 'EmpleadosCreate',
        component: EmpleadosCreate
    },
    {
        path: '/empleados/:id',
        name: 'EmpleadosEdit',
        component: EmpleadosEdit
    }
];