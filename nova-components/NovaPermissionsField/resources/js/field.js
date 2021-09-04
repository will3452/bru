Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-permissions-field', require('./components/IndexField'))
  Vue.component('detail-nova-permissions-field', require('./components/DetailField'))
  Vue.component('form-nova-permissions-field', require('./components/FormField'))
})
