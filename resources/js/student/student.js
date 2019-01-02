
require('./../vue-assets');

Vue.component('student-list', require('./StudentList.vue'));

const student = new Vue({
    el: '#student'
});
