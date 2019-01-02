<template>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header btn-success btn-block">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h4 class="modal-title"> Add New User </h4>
                </div>
                <div class="modal-body">
                   <form v-on:submit.prevent="storeData" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Name</label>
                            <input type="text" class="form-control" placeholder="Name" required v-model="userFormData.name">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" required v-model="userFormData.email">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password" required v-model="userFormData.password">
                        </div>
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>
</template>
<script>
    import { EventBus } from './../app.js';

    export default {
         data(){
            return {
                userFormData: {
                    name: '',
                    email: '',
                    password: ''
                }
            };
        },
        methods: {
            storeData(){
                axios.post(base_url+'users', this.userFormData).then( (response) => {
                    EventBus.$emit('new_user_added', response.data);
                })
            }
        }
    }
</script>