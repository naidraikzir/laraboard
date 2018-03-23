<template lang="pug">
div
  .card
    .card-body
      .form-group
        input.form-control(
          type="text"
          v-model="text"
          placeholder="Text Input")

      .form-group
        input.form-control(
          type="email"
          v-model="email"
          placeholder="Email Input")

      .form-group
        input.form-control(
          type="password"
          v-model="password"
          placeholder="Password Input")

      .form-group
        input.form-control(
          type="number"
          v-model.number="number"
          placeholder="Number Input")

      .form-group
        textarea.form-control(
          v-model="textarea"
          placeholder="Textarea"
          rows="5")

      .form-group
        .input-group
          .input-group-prepend
            .input-group-text @
          input.form-control(
            type="text"
            v-model="grouped"
            placeholder="Grouped Input")
          .input-group-append
            .input-group-text %

      .form-group
        .custom-file
          input.custom-file-input(
            type="file"
            @change="setFile")
          label.custom-file-label Choose File

      .form-group
        .custom-control.custom-checkbox(
          v-for="(option, i) of options"
          :key="i")
          input.custom-control-input(
            type="checkbox"
            :value="option"
            :id="`checkbox-${i}`"
            v-model="checked")
          label.custom-control-label(:for="`checkbox-${i}`") {{ option }}

      .form-group
        .custom-control.custom-radio(
          v-for="(option, i) of options"
          :key="i")
          input.custom-control-input(
            type="radio"
            :value="option"
            :id="`radio-${i}`"
            v-model="checkedRadio")
          label.custom-control-label(:for="`radio-${i}`") {{ option }}

      .form-group
        select.custom-select(v-model="selected")
          option(
            v-for="(option, i) of options"
            :value="option") {{ option }}

      .form-group
        input.form-control(
          type="range"
          :min="range.min"
          :max="range.max"
          v-model.number="selectedRange")

      .form-group
        quill-editor(
          v-model="quill"
          :options="quillOptions")
</template>

<script>
import { quillEditor } from 'vue-quill-editor';

export default {
  components: {
    quillEditor,
  },

  data() {
    return {
      text: null,
      email: null,
      password: null,
      number: null,
      textarea: null,
      grouped: null,
      files: null,
      options: [
        'one',
        'two',
        'three',
        'four',
      ],
      checked: [],
      checkedRadio: null,
      radio: null,
      selected: null,
      range: {
        min: 0,
        max: 250000,
      },
      selectedRange: null,
      quill: null,
      quillOptions: {},
    };
  },

  methods: {
    setFile(e) {
      this.files = e.target.files;
    },
  },
};
</script>
