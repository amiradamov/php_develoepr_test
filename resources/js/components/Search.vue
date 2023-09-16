<template>
  <div>
    <div class="search-form">
      <h2>Property Search</h2>
      <form @submit.prevent="searchProperties">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" v-model="searchQuery.name" />
        </div>
        <div class="form-group">
          <label for="bedrooms">Bedrooms</label>
          <input type="number" id="bedrooms" v-model="searchQuery.bedrooms" />
        </div>
        <div class="form-group">
          <label for="bathrooms">Bathrooms</label>
          <input type="number" id="bathrooms" v-model="searchQuery.bathrooms" />
        </div>
        <div class="form-group">
          <label for="storeys">Storeys</label>
          <input type="number" id="storeys" v-model="searchQuery.storeys" />
        </div>
        <div class="form-group">
          <label for="garages">Garages</label>
          <input type="number" id="garages" v-model="searchQuery.garages" />
        </div>
        <div class="form-group">
          <label for="price_min">Price Min</label>
          <input type="number" id="price_min" v-model="searchQuery.price_min" />
        </div>
        <div class="form-group">
          <label for="price_max">Price Max</label>
          <input type="number" id="price_max" v-model="searchQuery.price_max" />
        </div>
        <button type="submit">Search</button>
      </form>
    </div>
    <div class="search-results">
      <div v-if="loading" class="loading-indicator">Loading...</div>
      <table v-if="!loading" class="results-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Storeys</th>
            <th>Garages</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody v-if="properties.length > 0">
          <tr v-for="property in properties" :key="property.id">
            <td>{{ property.name }}</td>
            <td>{{ property.bedrooms }}</td>
            <td>{{ property.bathrooms }}</td>
            <td>{{ property.storeys }}</td>
            <td>{{ property.garages }}</td>
            <td>{{ property.price }}</td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr>
            <td colspan="6">No results found.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: {
        name: '',
        bedrooms: null,
        bathrooms: null,
        storeys: null,
        garages: null,
        price_min: null,
        price_max: null,
      },
      properties: [],
      loading: false,
    };
  },
  methods: {
    searchProperties() {
      this.loading = true;
      const apiUrl = '/search'; // Adjust the URL to match your Laravel API endpoint

      // Prepare the search parameters
      const queryParams = {
        params: this.searchQuery,
      };

      axios.get(apiUrl, queryParams)
        .then((response) => {
          this.properties = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.error('Error:', error);
          this.loading = false;
        });
    },
  },
};
</script>

<style scoped>
/* Add your CSS styles here */
</style>
