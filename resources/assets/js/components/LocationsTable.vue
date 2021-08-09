<template>
    <div>
        <form @submit.prevent="createLocation">
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input v-model="newLocationName" type="text" class="form-control" placeholder="Location Name" />
                <div class="input-group-append">
                    <button class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="row in locations" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteLocation(row.id)"><i class="fa fa-times" /> Delete</button></td>
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
            locations: [],
            newLocationName: '',
        };
    },
    mounted() {
        this.getLocations();
    },
    methods: {
        getLocations() {
            return axios.get('/api/locations')
                .then(response => {
                    this.locations = response.data;
                }).catch(console.error);
        },
        createLocation() {
            if(confirm('Are you sure?'))
                return axios.post('/api/locations', {name: this.newLocationName})
                    .then(this.getLocations)
                    .then(() => this.newLocationName = '')
                    .then(()=>this.$toastr.s("Location successfully created"))
                    .catch(console.error);
        },
        deleteLocation(id) {
            if(confirm('Are you sure?'))
                return axios.post('/api/locations/' + id, {_method: 'DELETE'})
                    .then(this.getLocations)
                    .then(()=>this.$toastr.s("Location successfully deleted"))
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