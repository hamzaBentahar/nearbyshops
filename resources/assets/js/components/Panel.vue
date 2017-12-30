<template>
    <div class="panel panel-default">
        <div class="panel-heading clearfix" v-show="hasTitleSlot">
            <slot name="title"></slot>
        </div>
        <div class="panel-body">
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>
  export default {
    computed: {
      hasTitleSlot () {
        return !!this.$slots['title']
      }
    }
  }
</script>