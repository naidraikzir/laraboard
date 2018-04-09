<template lang="pug">
quill-editor(
  :content="content"
  :options="options"
  @change="onEditorChange($event)"
  ref="editor")
</template>

<script>
import { quillEditor } from 'vue-quill-editor';

export default {
  components: {
    quillEditor,
  },

  props: {
    value: {
      type: String,
      default: '',
    },
    options: {
      type: Object,
      default: () => {},
    },
  },

  data() {
    return {
      content: '',
    };
  },

  computed: {
    editor() {
      return this.$refs.editor;
    },
  },

  watch: {
    value(val) {
      this.content = val;
    },
  },

  mounted() {
    this.editor.quill.getModule('toolbar')
      .addHandler('image', this.imageHandler);
  },

  methods: {
    async uploadImage(file) {
      const form = new FormData();
      form.append('image', file);
      try {
        const { data } = await this.http.post('/data/images', form);
        this.insertImageUrl(data);
      } catch (err) {
        console.error(err);
      }
    },
    onEditorChange({ html }) {
      this.$emit('input', html);
    },
    imageHandler() {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.click();

      // Listen upload local image and save to server
      input.onchange = () => {
        const file = input.files[0];

        // file type is only image.
        if (/^image\//.test(file.type)) {
          this.uploadImage(file);
        } else {
          console.warn('Hanya dapat menerima berkas gambar.');
        }
      };
    },
    insertImageUrl(url) {
      const range = this.editor.quill.getSelection();
      const finalUrl = process.env.LAN ?
        `/Laporan-Informasi/public${url}` :
        url;
      this.editor.quill.insertEmbed(range.index, 'image', finalUrl);
    },
  },
};
</script>
