import EmpleadosIndex from './components/empleados/Index.vue';
import EmpleadosCreate from './components/empleados/Create.vue';
import EmpleadosEdit from './components/empleados/Edit.vue';
import ExampleComponent from './components/ExampleComponent.vue';

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
    },
    {
        path: '/example',
        name: 'ExampleComponent',
        component: ExampleComponent
    },
];