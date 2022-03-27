import Login from './components/Login';
import Register from './components/Register';
import LoginTemperatures from './components/LoginTemperatures';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: LoginTemperatures
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    }
];
