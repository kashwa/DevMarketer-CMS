<template>
  <span class="icon is-small">{{comments}}
    <i :class="icon"></i>
    </span>
</template>

<script>
export default {
  props:{
    icon: {
      type: String,
      default: 'fa fa-comment m-l-5'
    },
    url:{
      required: true,
      type: String 
    },
    comments:{
      required: true,
      type: Number
    }
  },
  methods: {
    commentspls: function () {
      // this.$parent.comments = (this.$root.comments) += 1;
      // this.comments = this.$parent.comments;
    }
  }
}
</script>
