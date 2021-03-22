Nova.booting((Vue, router) => {
    Vue.component('index-send-test-mail', require('./components/IndexField'));
    Vue.component('detail-send-test-mail', require('./components/DetailField'));
    Vue.component('form-send-test-mail', require('./components/FormField'));
})
