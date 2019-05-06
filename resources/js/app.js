import './bootstrap';
import router from './routes';
import CurrentUsers from './components/CurrentUsers.vue'



new Vue({
    el: '#app',

    router,

    components: {
        CurrentUsers,
    }

});
