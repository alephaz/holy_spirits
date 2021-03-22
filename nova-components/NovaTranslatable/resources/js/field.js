Nova.booting((Vue, router) => {
    Vue.component('index-nova-translatable', require('./components/IndexField'));
    Vue.component('detail-nova-translatable', require('./components/DetailField'));
    Vue.component('form-nova-translatable', require('./components/FormField'));
})
