<template>
    <div>
         <!-- Form to create new Category -->
        <form @submit.prevent="createCategory">
            <div v-if="errors.length" class="alert alert-danger" role="alert">
                <strong>Please correct the following error(s):</strong>
                <ul>
                    <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Create new Category</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Parent Category</label>
                                <select v-model="parent_category_id" id="parent_category_id" class="form-control">
                                    <option value="">Is Parent Category</option>
                                    <option v-for="pc in parent_categories" :value="pc.id" :key="pc.id">{{ pc.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" v-model="name" type="text" placeholder="Category Name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <!-- Categories table -->
        <table class="table table-striped table-bordered m-t-20">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Parent Category</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in categories" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ (row.parent) ? row.parent.name : '' }}</td>
                    <td>{{ row.name }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            parent_categories: [],
            categories: [],

            name: '',
            parent_category_id: '',
        };
    },
    mounted() {
        this.getParentCategories();
        this.getCategories();
    },
    methods: {
        getCategories() {
            return axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                }).catch(console.error);
        },
        getParentCategories(){
            return axios.get('/api/categories?parent_category_id=null')
                .then(response => {
                    this.parent_categories = response.data;
                }).catch(console.error);
        },
        createCategory() {
            this.errors = [];
            if (!this.name) {
                this.errors.push('Name required.');
            }

            if(this.errors.length == 0)
            {
                
                if(confirm('Are you sure?'))
                    return axios.post('/api/categories', {parent_id: this.parent_category_id, name: this.name})
                        .then(this.getCategories)
                        .then(() => this.parent_category_id = '', this.name = '', this.errors = [], this.getParentCategories())
                        .then(()=>this.$toastr.s("Category successfully created"))
                        .catch(console.error);
            }
        },
        deleteCategory(id) {
            if(confirm('Are you sure?'))
                return axios.post('/api/categories/' + id, {_method: 'DELETE'})
                    .then(this.getCategories)
                    .then(()=>this.$toastr.s("Category successfully deleted"))
                    .catch(console.error);
        }
    }
}
</script>