Nova.booting((Vue, router) => {
    Vue.component('index-multi-date-selector', require('./components/IndexField'));
    Vue.component('detail-multi-date-selector', require('./components/DetailField'));
    Vue.component('form-multi-date-selector', require('./components/FormField'));
})
