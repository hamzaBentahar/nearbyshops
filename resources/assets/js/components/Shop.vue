<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail">
                    <img :src="info.picture" alt="name">
                    <div class="caption">
                        <h3 v-text="info.name"></h3>
                        <p v-if="buttons">
                            <a href="#" class="btn btn-danger" role="button" @click.prevent="like">Remove</a>
                        </p>
                        <p v-else>
                            <a href="#" class="btn btn-danger" role="button" @click.prevent="dislike">Dislike</a>
                            <a href="#" class="btn btn-success" role="button" @click.prevent="like">Like</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "shop",
    props: {
      info: {
        required: true,
        type: Object
      }
    },
    methods: {
      like() {
        axios.post('/like', {
          id: this.info.id
        }).then(() => {
          this.info.like = this.info.like === 1 ? 0 : 1;
        }).catch(() => {
          this.$toasted.show("You don't have the authorization to like this post. Unauthenticated", {
            theme: "bubble",
            position: "top-right",
            duration : 5000
          });
        })
      },
      dislike(){
        axios.post('/dislike', {
          id: this.info.id
        }).then(() => {
          // this.info.like = this.info.like === 1 ? 0 : 1;
        }).catch(() => {
          this.$toasted.show("You don't have the authorization to like this post. Unauthenticated", {
            theme: "bubble",
            position: "top-right",
            duration : 5000
          });
        })
      }
    },
    computed: {
      buttons(){
        return this.info.like
      }
    }
  }
</script>

<style scoped>

</style>