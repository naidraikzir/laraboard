<template lang="pug">
nav.navbar.bg-white.py-3
  a.d-inline-flex(@click.prevent.stop="$emit('toggle-menu')")
    menu-icon
  h5.m-0 {{ $route.name }}
  a.d-inline-flex(@click="logout")
    log-out-icon
</template>

<script>
import { LogOutIcon, MenuIcon } from 'vue-feather-icons';
import getCsrf from 'js/utils/get-csrf';

const csrf = getCsrf();

export default {
  name: 'topbar',

  components: {
    LogOutIcon,
    MenuIcon,
  },

  methods: {
    async logout() {
      try {
        const { data } = await this.http.post(
          '/logout',
          Object.assign(
            {},
            csrf
              ? {
                  _token: csrf,
                }
              : {},
          ),
          {
            baseURL: '/',
          },
        );
        window.location.href = data;
      } catch (err) {
        console.error(err);
      }
    },
  },
};
</script>
