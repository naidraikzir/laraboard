<template lang="pug">
#dashboard(:class="{ 'menu-hidden': !menu }")
  sidebar(@close-menu="closeMenu")
  .main(@click="closeMenu")
    topbar(@toggle-menu="toggleMenu")
    .container.py-4
      router-view
</template>

<script>
import Topbar from 'vue/partials/Topbar'
import Sidebar from 'vue/partials/Sidebar'

export default {
  name: 'dashboard',

  components: {
    Topbar,
    Sidebar
  },

  data () {
    return {
      menu: false
    }
  },

  created () {
    if (window.innerWidth > 960) {
      this.menu = true
    }
  },

  methods: {
    toggleMenu () {
      this.menu = !this.menu
    },
    closeMenu () {
      if (window.innerWidth < 960) {
        this.menu = false
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.main {
  background: #eef;
  min-height: 100vh;
  transition: 0.3s;
  will-change: margin;

  @media screen and (min-width: 960px) {
    margin-left: 200px;

    .menu-hidden & {
      margin-left: 0;
    }
  }
}
</style>

