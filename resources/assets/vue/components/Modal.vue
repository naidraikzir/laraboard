<template lang="pug">
.modal-backdrop(:class="{ 'fade show': show }")
  .modal(
    :class="{ 'fade show': show }"
    @click="hide")
    .modal-dialog(
      :class="sizeClass"
      @click.stop="")
      .modal-content
        .modal-header(v-if="hasHeader")
          slot(name="header")
        .modal-body(v-if="hasBody")
          slot(name="body")
        .modal-footer(v-if="hasFooter")
          slot(name="footer")
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: false,
    },
    size: {
      type: String,
      default: '',
    },
    critical: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    sizeClass() {
      return `modal-${this.size}`;
    },
    hasHeader() {
      return !!this.$slots.header;
    },
    hasBody() {
      return !!this.$slots.body;
    },
    hasFooter() {
      return !!this.$slots.footer;
    },
  },

  methods: {
    hide() {
      if (!this.critical) {
        this.$emit('close');
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.modal {
  display: block;
  opacity: 0;
  transition: 0.3s;
  visibility: hidden;

  &.fade.show {
    opacity: 1;
    visibility: visible;
  }

  &-backdrop {
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    transition: 0.3s;
    visibility: hidden;

    &.fade.show {
      opacity: 1;
      visibility: visible;
    }
  }
}
</style>
