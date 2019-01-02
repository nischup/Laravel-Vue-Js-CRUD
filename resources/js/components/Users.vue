<template>
    <div class="container">
        <div class="row">
            <button class="btn btn-success pull-right padding-top" data-toggle="modal" data-target="#myModal"> Add User </button>
        </div>
        


        <table class="table table-striped">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Created Date </th>
                    <th> Action </th>
                </tr>
            </thead>
                <tbody>
                    <tr v-for="(user, index) in userList">
                        <td> {{ serial(index) }} </td>
                        <td> {{ user.name }} </td>
                        <td> {{ user.email }} </td>
                        <td> {{ user.created_at }} </td>
                        <td>
                            <a class="btn btn-danger" @click.prevent="deleteUser(user.id, index)"> <span class="glyphicon glyphicon-trash"></span> </a>
                            <a class="btn btn-success"> <span class="glyphicon glyphicon-edit"></span> </a>
                        </td>
                    </tr>
                </tbody>
         </table>

         <AddUser></AddUser>

    </div>
</template>


<script>  
    import { EventBus } from './../app.js'; 
    import VueToastr2 from 'vue-toastr-2'
    import 'vue-toastr-2/dist/vue-toastr-2.min.css'
    import AddUser from './AddUser.vue';
    window.toastr = require('toastr')
     
    Vue.use(VueToastr2)

    export default {
        components: {
            AddUser
        },

        data(){
            return {
                userList: {}
            };
        },

        methods: {
            getuserData:function() {

              axios.get(base_url+'users')
                    .then( (response) => {
                        this.userList = response.data;
                });
           },
            deleteUser:function(id, index) {

              axios.delete(base_url+'users/'+id)
                    .then( (response) => {
                         this.$toastr.success('Message', 'User has been Deleted');
                        this.userList.splice(index, 1);
                });
           },
           serial: function (index) {
            return index+1
            }
        },

        created(){
            var _this = this;
            _this.getuserData();
            
            EventBus.$on('new_user_added', function(newUser) {
                _this.userList.push(newUser);
                 $('#myModal').modal('hide');
            });
        }
    }; 

</script>

