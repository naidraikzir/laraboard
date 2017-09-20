<template lang="pug">
.sidebar.bg-dark-blue
  ul
    li(v-for="(menu, key) of menus" :key="key")
      router-link(:to="{ path: menu.path }" :exact="menu.exact")
        div(@click="$emit('close-menu')") {{ menu.text }}
</template>

<script>
import menus from 'js/menus'

export default {
  name: 'sidebar',
  
  data () {
    return {
      menus
    }
  }
}
</script>

<style lang="scss" scoped>
.sidebar {
  height: 100%;
  left: 0;
  overflow-x: hidden;
  overflow-y: auto;
  position: fixed;
  top: 0;
  transition: 0.3s;
  width: 200px;
  will-change: width;
  z-index: 100;

  .menu-hidden & {
    width: 0;
  }
}

ul {
  list-style: none;
  margin-top: 5em;
  padding: 0;

  &:hover div {
    color: rgba(255, 255, 255, 0.5);
  }

  a {
    color: white;
    text-decoration: none;

    &:hover div,
    &.active div {
      color: white;
    }

    &.active div {
      background-color: #7339ff;
      background-image: linear-gradient(to right, #7339ff, #59ffe0);
    }
  }

  div {
    border-radius: 0 4px 4px 0;
    margin-right: 1em;
    padding: 0.5em 1.5em;
    transition: 0.3s;

    .menu-hidden & {
      border-radius: 0;
      margin: 0;
    }
  }
}
</style>
