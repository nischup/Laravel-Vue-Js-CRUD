<template>
    <div class="container">
        <div class="row well" style="margin-top: 40px;">
            <form method="post" v-on:submit.prevent="store" class="form-horizontal" id="addComponent" role="form">

                 <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"> Name </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.name" class="form-control" placeholder="Name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('name'))" style="color: red;"> {{ (errors.hasOwnProperty('name')) ? errors.name[0] :'' }} </small>
                    </div>
                  </div> 

                <div class="form-group">
                    <label for="about" class="col-sm-3 control-label"> Mobile </label>
                    <div class="col-sm-9">
                        <input type="text" v-model="form.mobile" class="form-control" placeholder="Mobile">
                         <small class="help-block" v-if="(errors.hasOwnProperty('mobile'))" style="color: red;"> {{ (errors.hasOwnProperty('mobile')) ? errors.mobile[0] :'' }} </small>
                    </div>
                </div> 

                 <div class="form-group">
                    <label for="about" class="col-sm-3 control-label"> Email </label>
                    <div class="col-sm-9">
                        <input type="text" v-model="form.email" class="form-control" placeholder="Email">
                         <small class="help-block" v-if="(errors.hasOwnProperty('email'))" style="color: red;"> {{ (errors.hasOwnProperty('email')) ? errors.email[0] :'' }} </small>
                    </div>
                </div>
            

                <div class="form-group">
                    <label for="about" class="col-sm-3 control-label"> Photo </label>
                    <div class="col-sm-9">
                         <img :src="form.image" class="img-responsive">
                         <input type="file" v-on:change="onFileChange" class="form-control">
                    </div>
                </div>

                  <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"> Address </label>
                    <div class="col-sm-9">
                        <textarea class="form-control" v-model="form.address"></textarea>
                         <small class="help-block" v-if="(errors.hasOwnProperty('address'))" style="color: red;"> {{ (errors.hasOwnProperty('address')) ? errors.address[0] :'' }} </small>
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button class="btn btn-success btn-block" type="submit" :disabled="!isComplete"> Save </button>
                    </div>
                  </div>

            </form>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../vue-assets';
    export default {

        components: {  },

        // props:[''],

        data:function(){
            return {
                list:false,
                add_form:true,
                edit_form:false,
                view_form:false,

                form:{
                    name: '',
                    email: '',
                    mobile: '',
                    photo: '',
                    image: '',
                    address: '',
                    
                },
                errors: {},
            };
        },

        methods:{
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.form.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            store:function() {
                var _this = this;
                axios.post(base_url+'student', _this.form).then( (response) => {
                    this.showMassage(response.data);
                    EventBus.$emit('data-changed');
                }).catch(error => {
					if(error.response.status == 422){
						this.errors = error.response.data.errors;
					}else{
						this.showMassage(error);
					}
				});
            },

            showMassage(data){
                if(data.status == 'success'){
                    toastr.success(data.message, 'Success Alert');
                }else if(data.status == 'error'){
                    toastr.error(data.message, 'Error Alert');
                }else{
                    toastr.error(data.message, 'Error Alert');
                }
            },
        },

        computed: {
          isComplete () {
            return this.form.mobile;
          }
        },

    }
</script>
<style scoped>
    img{
        max-height: 66px;
    }
</style>
