<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail">
                    <img :src="picture" alt="name">
                    <div class="caption">
                        <h3 v-text="name"></h3>
                        <p>
                            <a href="#" class="btn btn-danger" role="button">Dislike</a>
                            <a href="#" class="btn btn-success" role="button">Like</a>
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
      picture: {
        required: true,
        type: String
      },
      name: {
        required: true,
        type: String
      },
      id: {
        required: true,
        type: Number
      }
    }
  }
</script>

<style scoped>

</style>