<template lang="pug">
ul.pagination
  li.page-item.shadow-1(v-if="isPrevVisible")
    a.page-link.border-0(@click="go(currentPage - 1)")
      chevron-left-icon(
        width="1em"
        height="1em"
        viewBox="2.5 0 19 19")
  li.page-item.shadow-1(
    v-for="(page, i) of mutatedPages"
    :key="i"
    :class="{ 'active': currentPage === page }")
    span.page-link.border-0(v-if="typeof page === 'string'")
      more-horizontal-icon(
        height="1em"
        viewBox="2.5 0 19 19")
    span.page-link.border-0(v-else-if="page === currentPage") {{ page }}
    a.page-link.border-0(
      @click="go(page)"
      v-else) {{ page }}
  li.page-item.shadow-1(v-if="isNextVisible")
    a.page-link.border-0(@click="go(currentPage + 1)")
      chevron-right-icon(
        width="1em"
        height="1em"
        viewBox="2.5 0 19 19")
</template>

<script>
import {
  MoreHorizontalIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
} from 'vue-feather-icons';

export default {
  components: {
    MoreHorizontalIcon,
    ChevronLeftIcon,
    ChevronRightIcon,
  },

  props: {
    pages: {
      type: Number,
      default: 1,
    },
    currentPage: {
      type: Number,
      default: 1,
    },
  },

  computed: {
    isPrevVisible() {
      return this.currentPage > 1;
    },
    isNextVisible() {
      return this.currentPage < this.pages;
    },
    mutatedPages() {
      if (this.pages <= 1) {
        return [1];
      } else if (this.pages > 1 && this.pages < 8) {
        return this.getPageRange();
      }
      return this.getPageSlider();
    },
  },

  methods: {
    getPageRange() {
      return [...Array(this.pages).keys()].map(key => key + 1);
    },
    getPageSlider() {
      if (this.currentPage <= 4) {
        // inside first 4
        return [...Array(5).keys()].map(key => key + 1).concat(...['skip', this.pages]);
      } else if (this.currentPage >= this.pages - 3) {
        // inside last 4
        return [1, 'skip'].concat(...[...Array(5).keys()].map(key => (this.pages - 4) + key));
      }
      // centered
      return [1, 'skip']
        .concat(...[...Array(3).keys()].map(key => (key + this.currentPage) - 1))
        .concat(...['skip', this.pages]);
    },
    go(page) {
      this.$emit('go', page);
    },
  },
};
</script>
