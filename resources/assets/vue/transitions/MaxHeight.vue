<template lang="pug">
transition(name="max-height")
  slot
</template>

<style lang="scss" scoped>
.max-height {
  &-enter,
  &-leave-to {
    max-height: 0;
    padding-bottom: 0;
    padding-top: 0;
  }

  &-enter-active,
  &-leave-active {
    overflow: hidden;
    transition: 0.3s;
  }

  &-enter-to,
  &-leave {
    max-height: 100em;
  }
}
</style>
