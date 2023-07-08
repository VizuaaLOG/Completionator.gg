import Show from '@/screens/Games/Show.vue';

export default [
    {
        path: '/games/:id',
        name: 'games.show',
        component: Show,
        props: true,
    },
];
