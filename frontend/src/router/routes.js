import Welcome from '../components/Welcome.vue';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import Dashboard from '../components/Dashboard.vue';

export default [
    {
        path: '/',
        component: Welcome,
        name: 'welcome'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'dashboard',
        meta: {
            auth: true
        }
    },

];