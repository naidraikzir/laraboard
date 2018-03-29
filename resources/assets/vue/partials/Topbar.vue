<template lang="pug">
nav.navbar.bg-white.py-3
  a.d-inline-flex(@click.prevent.stop="$emit('toggle-menu')")
    menu-icon
  h5.m-0 {{ $route.name }}
  a.d-inline-flex(@click="logout")
    log-out-icon
</template>

<script>
import {
  LogOutIcon,
  MenuIcon,
} from 'vue-feather-icons';

export default {
  name: 'topbar',

  components: {
    LogOutIcon,
    MenuIcon,
  },

  methods: {
    logout() {
      this.http.post('/logout', {
        _token: document.getElementsByName('csrf-token')[0]
          .getAttribute('content'),
      })
        .then(({ data }) => {
          window.location.href = data;
        });
    },
  },
};
</script>
