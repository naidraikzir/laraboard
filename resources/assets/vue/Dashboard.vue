<template lang="pug">
#dashboard(:class="{ 'menu-hidden': !menu }")
  portal-target(name="modals")
  transition-group.alert-container(name="list-slide")
    alert(
      v-for="(alert, i) of alerts"
      :key="i"
      :type="alert.type"
      :message="alert.message")
  sidebar(@close-menu="closeMenu")
  .main(@click="closeMenu")
    topbar(@toggle-menu="toggleMenu")
    .container.py-4
      router-view
</template>

<script>
import { mapGetters } from 'vuex';
import Topbar from 'vue/partials/Topbar';
import Sidebar from 'vue/partials/Sidebar';
import Alert from 'vue/components/Alert';

export default {
  name: 'dashboard',

  components: {
    Topbar,
    Sidebar,
    Alert,
  },

  data() {
    return {
      menu: false,
    };
  },

  computed: {
    ...mapGetters([
      'alerts',
    ]),
  },

  created() {
    if (window.innerWidth > 960) {
      this.menu = true;
    }
  },

  methods: {
    toggleMenu() {
      this.menu = !this.menu;
    },
    closeMenu() {
      if (window.innerWidth < 960) {
        this.menu = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.main {
  background: #eef;
  box-shadow: -0.5em 0 5em 0 rgba(0, 0, 0, 0.05);
  min-height: 100vh;
  position: relative;
  transform: translateX(220px);
  transition: 0.3s;
  will-change: margin, transform;
  z-index: 1;

  .menu-hidden & {
    transform: translateX(0);
  }

  @media screen and (min-width: 960px) {
    margin-left: 220px;
    transform: translateX(0);

    .menu-hidden & {
      margin-left: 0;
    }
  }
}
</style>

