Nova.booting((Vue, router) => {
    Vue.component('index-create-donated-user', require('./components/IndexField'));
    Vue.component('detail-create-donated-user', require('./components/DetailField'));
    Vue.component('form-create-donated-user', require('./components/FormField'));
})
