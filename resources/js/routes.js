import PublicHolidays from './components/PublicHolidays';
import Stats from './components/Stats';
import notFound from './components/notFound';

export default{
    mode: 'history',

    linkActiveClass: 'font-weight-bold',

    routes: [
        {
            path: '/',
            component: PublicHolidays
        },
        {
            path: '/stats/:label',
            name: 'Stats',
            component: Stats,
            props: true
        },
        {
            path: '*',
            component: notFound
        }
    ]
}