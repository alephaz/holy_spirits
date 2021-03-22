import VueVideoPlayer from 'vue-video-player'

Nova.booting((Vue, router) => {

    Vue.use(VueVideoPlayer);

    Vue.component('index-custom-video', require('./components/IndexField'));
    Vue.component('detail-custom-video', require('./components/DetailField'));
    Vue.component('form-custom-video', require('./components/FormField'));
})
