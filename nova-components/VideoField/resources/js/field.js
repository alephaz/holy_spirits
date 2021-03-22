import VueYoutube from 'vue-youtube';

Nova.booting((Vue, router) => {

    Vue.use(VueYoutube);

    Vue.component('index-video-field', require('./components/IndexField'));
    Vue.component('detail-video-field', require('./components/DetailField'));
    Vue.component('form-video-field', require('./components/FormField'));
})
