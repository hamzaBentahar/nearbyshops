<template>
    <div class="row">
        <div class="col-md-12">
            <div v-if="!shops">
                <p>Waiting</p>
            </div>
            <div v-for="shop in shops" class="col-md-2 col-sm-3 col-xs-6" v-else>
                <shop :picture="shop.picture" :name="shop.name" :id="shop.id" :info="shop"></shop>
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
        shops: null
      }
    },
    mounted() {
      this.userLocation()
    },
    methods: {
      // Use the HTML geolocation API to get the current position of the user
      userLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(position => {
            // Send an ajax request with the user's latitude and longitude
            axios.get(this.url+'?latitude=' + position.coords.latitude + '&longitude=' + position.coords.longitude)
              .then(data => {
                var infos = data.data
                infos = Object.keys(infos).map(key => {
                  return infos[key]
                })
                infos.sort((a, b) => {
                  return a.distance - b.distance
                })
                this.shops = infos
              })
          })
        }
      }
    }
  }
</script>

<style scoped>

</style>