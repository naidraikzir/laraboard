<template lang="pug">
.alert(
  :class="typeString"
  role="alert"
  v-html="message")
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: 'default',
    },
    message: {
      type: String,
      default: '🤔',
    },
  },

  computed: {
    typeString() {
      return `alert-${this.type}`;
    },
  },
};
</script>
