<template>
    <div>
        <form @submit.prevent="filterReport">
            <div class="create-location-form input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Price</span>
                </div>
                <input v-model="price" type="number" class="form-control" placeholder="Enter Price" />
                <div class="input-group-append">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <table v-if="results.length" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Location</th>
                <th>Parent Category</th>
                <th>Category</th>
                <th>Count</th>
            </thead>
            <tbody>
                <tr v-for="row in results" :key="row.id">
                    <td>{{ row.location }}</td>
                    <td>{{ row.parent_category }}</td>
                    <td>{{ row.category }}</td>
                    <td>{{ row.count }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            results: [],
            price: 0,
        };
    },
    methods: {
        filterReport() {
            return axios.get('/api/report?price='+this.price)
                .then(response => {
                    this.results = response.data;
                }).catch(console.error);
        },
    }
}
</script>
