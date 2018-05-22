<template lang="pug">
.loading(:style="{ height: height }")
  span(:style="style")
</template>

<script>
export default {
  props: {
    height: {
      type: String,
      default: '100%',
    },
    color: {
      type: String,
      default: 'white',
    },
  },

  computed: {
    style() {
      return {
        backgroundColor: this.color,
        borderColor: this.color,
      };
    },
  },
};
</script>

<style lang="scss" scoped>
@keyframes loading {
  0% { opacity: 0; transform: translate(-50%, -50%) scale(0); }
  50% { opacity: 1; transform: translate(-50%, -50%) scale(0); }
  100% { opacity: 0; transform: translate(-50%, -50%) scale(1); }
}

.loading {
  min-width: 2em;
  position: relative;
  width: 100%;

  > span {
    animation: 1s linear infinite loading;
    border: 2em solid;
    border-radius: 50%;
    height: 2em;
    left: 50%;
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 2em;
  }
}
</style>
