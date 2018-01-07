<template>
    <div class="row">
        <div class="col-md-12">
            <!--If we can't display through the list of shops, we display the error-->
            <div v-if="!shops">
                <p v-html="error"></p>
            </div>
            <!--iterate through the list of shop and displaying them in the shop component-->
            <div v-for="shop in shops" class="col-md-2 col-sm-3 col-xs-6" v-else>
                <shop :info="shop"></shop>
            </div>
        </div>
    </div>
</template>

<script>
  import Shop from './Shop'
  Vue.component('shop', Shop)
  export default {
    name: "shops",
    components: {
      Shop
    },
    props: {
      url: {
        required: true,
        type: String
      }
    },
    data() {
      return {
        shops: null,
        error: "Waiting"
      }
    },
    mounted() {
      // Get the user location when the page is ready
      this.userLocation()
    },
    methods: {
      // Use the HTML geolocation API to get the current position of the user
      userLocation() {
        // Prompt the user to confirm to share his location
        // If the user accepts, we display the shops
        // Else, we display an error message
        if (navigator.geolocation) {
          // Send an ajax request with the user's latitude and longitude
          // Handle errors if any
          navigator.geolocation.getCurrentPosition(position => {
            axios.get(this.url+'?latitude=' + position.coords.latitude + '&longitude=' + position.coords.longitude)
              .then(data => {
                // store the returned data in local variable
                var infos = data.data
                // sort the data by distance, the nearest first.
                infos = Object.keys(infos).map(key => {
                  return infos[key]
                })
                infos.sort((a, b) => {
                  return a.distance - b.distance
                })
                this.shops = infos
              })
          }, this.showError)
        }
        else {
            this.error = "Geolocation is not supported by this browser"
        }
      },
      // Function to display errors if exists
      showError(error){
        switch (error.code){
          // If the user denied the permission
          case error.PERMISSION_DENIED:
            this.error = 'The request for geolocation was denied.'
            break
          // If the browser can't retrieve the location
          case error.POSITION_UNAVAILABLE:
            this.error = "Location information is unavailable."
            break
          // Time out
          case error.TIMEOUT:
            this.error = "The request to get the location timed out."
            break
          // For other errors
          case error.UNKNOWN_ERROR:
            this.error = "An unknown error occurred."
            break;
        }
      }
    }
  }
</script>

<style scoped>

</style>