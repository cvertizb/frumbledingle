<template>
    <div>
        <!-- Form to create new Item -->
        <form @submit.prevent="createItem">
            <div v-if="errors.length" class="alert alert-danger" role="alert">
                <strong>Please correct the following error(s):</strong>
                <ul>
                    <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Create new Item</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" v-model="name" type="text" placeholder="Item Name">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="location_id">Location</label>
                                <select v-model="location_id" id="location_id" class="form-control">
                                    <option value="0">Select an option</option>
                                    <option v-for="l in locations" :value="l.id" :key="l.id">{{ l.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="parent_category_id">Parent Category</label>
                                <select v-model="parent_category_id" id="parent_category_id" class="form-control" @change="onParentCategoryChange($event)" required>
                                    <option value="-1">Select an option</option>
                                    <option v-for="pc in parent_categories" :value="pc.id" :key="pc.id">{{ pc.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select v-model="category_id" id="category_id" class="form-control" required>
                                    <option value="0">Select an option</option>
                                    <option v-for="c in categories" :value="c.id" :key="c.id">{{ c.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" step=".01" v-model="price" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <!-- Items table -->
        <table class="table table-striped table-bordered m-t-20">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Parent Category</th>
                <th>Category</th>
                <th>Price</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.location }}</td>
                    <td>{{ row.parent_category }}</td>
                    <td>{{ row.category }}</td>
                    <td>$ {{ row.price }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteItem(row.id)"><i class="fa fa-times" /> Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
import axios from 'axios';
import VueToastr from "vue-toastr";

export default {
    data() {
        return {
            errors: [],
            items: [],
            parent_categories: [],
            categories: [],
            locations: [],

            name: '',
            parent_category_id: -1,
            category_id: 0,
            location_id: 0,
            price: 0,
        };
    },
    components: {
        VueToastr
    },
    mounted() {
        this.getParentCategories();
        this.getLocations();
        this.getItems();
    },
    methods: {
        getItems() {
            return axios.get('/api/items')
                .then(response => {
                    this.items = response.data;
                }).catch(console.error);
        },
        getParentCategories(){
            return axios.get('/api/categories?parent_category_id=-1')
                .then(response => {
                    this.parent_categories = response.data;
                }).catch(console.error);
        },
        getCategories(parent_id){
            return axios.get('/api/categories?parent_category_id='+ parent_id)
                            .then(response => {
                                this.category_id = 0;
                                this.categories = response.data;
                            }).catch(console.error);
        },
        onParentCategoryChange(event)
        {
            this.getCategories(event.target.value)            
        },
        getLocations(){
            return axios.get('/api/locations')
                            .then(response => {
                                this.locations = response.data;
                            }).catch(console.error);
        },

        createItem() {
            this.errors = [];
            if (!this.name) {
                this.errors.push('Name required.');
            }
            if (!this.location_id) {
                this.errors.push('Location required.');
            }
            if (!this.parent_category_id) {
                this.errors.push('Parent category required.');
            }
            if (!this.price || this.price < 0) {
                this.errors.push('Price should be greater than 0.');
            }

            if(this.errors.length == 0)
            {
                var cat_id = 0;
                (this.category_id == 0) ? cat_id = this.parent_category_id : cat_id = this.category_id
                
                if(confirm('Are you sure?'))
                    return axios.post('/api/items', {name: this.name, location: this.location_id, category: cat_id, price: this.price})
                        .then(response => this.$toastr.s(response.data.message))
                        .then(() => this.name = '', this.location_id = 0, this.parent_category_id = 0, this.category_id = 0, this.price = 0, this.errors = [])
                        .then(this.getItems)
                        .catch(console.error);
            }
        },
        deleteItem(id) {
            if(confirm('Are you sure?'))
                return axios.post('/api/items/' + id, {_method: 'DELETE'})
                    .then(response => this.$toastr.s(response.data.message))
                    .then(this.getItems)
                    .catch(console.error);
        }
    }
}
</script>

<style>
.create-location-form {
    margin-bottom: 10px;
}
</style>