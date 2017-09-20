<template lang="pug">
nav.navbar.bg-white.py-3
  a.d-inline-flex(@click.prevent.stop="$emit('toggle-menu')")
    menu-icon
  h5.m-0 {{ $route.name }}
  a.d-inline-flex(@click="logout")
    logout-icon
</template>

<script>
import LogoutIcon from 'vue-feather-icon/components/log-out'
import MenuIcon from 'vue-feather-icon/components/menu'

export default {
  name: 'topbar',

  components: {
    LogoutIcon,
    MenuIcon
  },

  methods: {
    logout () {
      
    }
  }
}
</script>
