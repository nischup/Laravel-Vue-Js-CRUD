<template>
	<div class="container">

		<div class="row well" style="margin-top: 20px;">
			<form method="post" v-on:submit.prevent="formSubmit" class="form-horizontal" role="form">

				<input type="hidden" v-model="productFormData.id">
				 <div class="form-group">
				    <label for="name" class="col-sm-3 control-label"> Product Name </label>
				    <div class="col-sm-9">
				      <input type="text" v-model="productFormData.product_name" class="form-control" placeholder="Product Name">
				       <small class="help-block" v-if="(errors.hasOwnProperty('product_name'))" style="color: red;"> {{ (errors.hasOwnProperty('product_name')) ? errors.product_name[0] :'' }} </small>
				    </div>
				  </div> 

				  <div class="form-group">
				    <label for="name" class="col-sm-3 control-label">Product Description</label>
				    <div class="col-sm-9">
				    	<textarea class="form-control" v-model="productFormData.product_description"></textarea>
				    	 <small class="help-block" v-if="(errors.hasOwnProperty('product_description'))" style="color: red;"> {{ (errors.hasOwnProperty('product_description')) ? errors.product_description[0] :'' }} </small>
				    </div>
				  </div> 

				  <div class="form-group">
				    <label for="about" class="col-sm-3 control-label">Product Price</label>
				    <div class="col-sm-9">
				      	<input type="text" v-model="productFormData.product_price" class="form-control" placeholder="Product price">
				      	 <small class="help-block" v-if="(errors.hasOwnProperty('product_price'))" style="color: red;"> {{ (errors.hasOwnProperty('product_price')) ? errors.product_price[0] :'' }} </small>
				    </div>
				  </div>

				  <div class="form-group">
				    <div class="col-sm-6 col-sm-offset-3">
				      	<button class="btn btn-success btn-block" type="submit" :disabled="!isComplete" v-text="productFormData.id ? 'Update' : 'Save'"></button>
				    </div>
				  </div>

			</form>
		</div>

		<div class="row">
	        <table class="table table-striped">
	            <thead>
	                <tr>
	                    <th> # </th>
	                    <th> Product Name </th>
	                    <th> Product Description </th>
	                    <th> Product Price </th>
	                    <th> Created Date </th>
	                    <th> Action </th>
	                </tr>
	            </thead>
	                <tbody>
	                    <tr v-for="(product, index) in productList">
	                        <td> {{ serial(index) }} </td>
	                        <td> {{ product.product_name }} </td>
	                        <td> {{ product.product_description }} </td>
	                        <td> {{ product.product_price }} </td>
	                        <td> {{ product.created_at }} </td>
	                        <td>
	                            <a class="btn btn-danger" @click.prevent="deleteProduct(product.id, index)"> <span class="glyphicon glyphicon-trash"> </span> </a>
	                            <a class="btn btn-success"  @click.prevent="editProduct(product)"> <span class="glyphicon glyphicon-edit"> </span> </a>
	                        </td>
	                    </tr>
	                </tbody>
	         </table>
		</div>
	</div>
</template>

<script>
	// import { EventBus } from './../app.js'; 
	import VueToastr2 from 'vue-toastr-2'
	import 'vue-toastr-2/dist/vue-toastr-2.min.css'
	window.toastr = require('toastr')
	Vue.use(VueToastr2)

	    export default {
        data(){
            return {
                productList: {},

                productFormData: {
                    id: '',
                    product_name: '',
                    product_description: '',
                    product_price: ''
                },
                errors: {}
            };
        },

        methods: {
        	formSubmit(){
        		if (this.productFormData.id) {
        			this.updateProduct();
        		}else{
        			this.storeProduct();
        		}
        	},
            getproductData:function() {
              axios.get(base_url+'products')
                    .then( (response) => {
                        this.productList = response.data;
                });
           },
            storeProduct(){
            	console.log('storing');
                axios.post(base_url+'products', this.productFormData)
                .then( (response) => {
                	this.$toastr.success('Message', 'Product has been Added');
                     this.productList.unshift(response.data);
                     	this.productFormData = {
		                    product_name: '',
		                    product_description: '',
		                    product_price: ''
		                };
		                this.errors = {}
                })
                .catch(error => {
					if(error.response.status == 422){
						this.errors = error.response.data.errors;
					}
				});
        	},	
        	updateProduct(){
        		console.log('updating');
                axios.put(base_url+'products/'+this.productFormData.id, this.productFormData)
                .then( (response) => {
                	this.$toastr.success('Message', 'Product has been Updated');
                	let objIndex = this.productList.findIndex((obj => obj.id == response.data.id));
                	this.productList[objIndex] = response.data;

                	console.log(response.data);
                     	this.productFormData = {
		                    product_name: '',
		                    product_description: '',
		                    product_price: ''
		                };
		                this.errors = {}
                })
                .catch(error => {
					if(error.response.status == 422){
						this.errors = error.response.data.errors;
					}
				});
        	},	

        	editProduct(product) {
        		this.productFormData = {
                    id: product.id,
                    product_name: product.product_name,
                    product_description: product.product_description,
                    product_price: product.product_price
                };
        	},

        	deleteProduct(id, index){
        		axios.delete(base_url+'products/'+id)
                    .then( (response) => {
                         this.$toastr.success('Message', 'Product has been Deleted');
                        this.productList.splice(index, 1);
                });
        	},

           serial: function (index) {
            return index+1
            }
        },
        created(){
            var _this = this;
            _this.getproductData();
        },
		computed: {
		  isComplete () {
		    return this.productFormData.product_name && this.productFormData.product_description && this.productFormData.product_price;
		  }
		}
    }; 
</script>

