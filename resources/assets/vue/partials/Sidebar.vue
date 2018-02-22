<template lang="pug">
.sidebar
  ul
    li(v-for="(menu, key) of menus" :key="key")
      router-link(:to="{ path: menu.path }" :exact="menu.exact" v-if="!menu.title")
        div(@click="$emit('close-menu')") {{ menu.text }}
      .title(v-else)
        span {{ menu.text }}
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
  background: #eef;
  height: 100%;
  left: 0;
  overflow-x: hidden;
  overflow-y: auto;
  position: fixed;
  top: 0;
  transition: 0.3s;
  width: 220px;
  will-change: width;
}

ul {
  list-style: none;
  margin-top: 5em;
  padding: 0;

  li + li {
    margin-bottom: 0.5em;
  }

  &:hover div {
    color: rgba(0, 0, 0, 0.5);
  }

  .title {
    margin-top: 1em;
  }

  .title span {
    color: rgba(0, 0, 0, 0.35);
    display: inline-block;
    font-size: 0.7em;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    width: 100%;
  }

  a {
    color: inherit;
    text-decoration: none;

    &:hover div,
    &.active div {
      color: inherit;
    }

    &.active div {
      background-color: #7339ff;
      background-image: linear-gradient(to right, #7339ff, #59ffe0);
      box-shadow: 0 1em 1em -0.5em rgba(0, 0, 0, 0.05);
      color: white;
    }
  }

  div {
    border-radius: 4px;
    margin: 0 1em;
    overflow: hidden;
    padding: 0.5em 1em;
    text-overflow: ellipsis;
    transition: 0.3s;
    white-space: nowrap;
  }
}
</style>
