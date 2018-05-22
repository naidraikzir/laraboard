<template lang="pug">
div
  .row(v-if="searchable")
    .form-group.col-md-4.offset-md-8
      .search
        input.form-control.shadow-1(
          type="search"
          :class="setBorder()"
          placeholder="Search..."
          v-model="keyword")
        a.reset(
          @click="keyword = ''"
          v-show="keyword")
          x-icon(stroke="#f00")

  .table-responsive(:class="[setBorder(), setShadow()]")
    table.table
      thead
        tr
          th(v-if="hasChild")
          th(
            v-for="(column, i) of columns"
            :key="i"
            :class="setClass(column)"
            :style="column.styles")
            a(
              v-if="column.sortable"
              @click="sort(column.name)")
              | {{ column.text }}
              template(v-if="sortBy === column.name")
                span(v-if="sortDir === 'desc'") ⇂
                span(v-else-if="sortDir === 'asc'") ↾
              span(v-else)  ⇵
            template(v-else) {{ column.text }}

      tbody(v-if="!rows.length")
        tr
          td.text-center(
            :colspan="columns.length"
            v-if="loading")
            loading(
              color="#007aff"
              height="3em")
          td.text-center(
            :colspan="columns.length"
            v-else) {{ noneText }}

      tbody(v-else)
        template(v-for="(row, r) of rows")
          tr
            td.text-center(v-if="hasChild")
              a(
                @click="toggleChild(r)"
                v-if="row.hasChild")
                chevron-down-icon(v-if="getChildShownIndex(r) < 0")
                chevron-up-icon(v-else)
            td(
              v-for="(column, c) of columns"
              :key="c")
              slot(
                :name="column.name"
                :row="row") {{ row[column.name] }}
          tr(v-if="row.hasChild")
            max-height-transition
              td(
                :colspan="columns.length + 1"
                v-show="getChildShownIndex(r) > -1")
                max-height-transition
                  div(v-show="getChildShownIndex(r) > -1")
                    slot(
                      name="child"
                      :row="row") Nope

  .row(v-if="paginated")
    .col-12.col-md-5.text-center.text-md-left.mb-3
      select.custom-select.shadow-1(
        @change="onPerPage"
        :class="setBorder()"
        style="max-width: 5em;")
        option(
          v-for="(count, i) of perPages"
          :key="i"
          :value="count"
          :selected="perPage === count") {{ count }}
      .d-inline-block.ml-3.mt-1
        small Displaying {{ rows.length }} of {{ total }}
    .col-12.col-md-7
      pagination.float-md-right(
        :pages="lastPage"
        :current-page="currentPage"
        @go="toPage($event)"
        v-if="lastPage > 1")
</template>

<script>
import Loading from 'vue/components/Loading';
import Pagination from 'vue/components/Pagination';
import {
  XIcon,
  ChevronDownIcon,
  ChevronUpIcon,
} from 'vue-feather-icons';
import MaxHeightTransition from 'vue/transitions/MaxHeight';
import debounce from 'debounce';

export default {
  components: {
    ChevronDownIcon,
    ChevronUpIcon,
    Loading,
    MaxHeightTransition,
    Pagination,
    XIcon,
  },

  props: {
    border: {
      type: Boolean,
      default: false,
    },
    shadow: {
      type: Boolean,
      default: true,
    },
    columns: {
      type: Array,
      default: () => [],
    },
    loading: {
      type: Boolean,
      default: false,
    },
    rows: {
      type: Array,
      default: () => [],
    },
    noneText: {
      type: String,
      default: 'There\'s no data',
    },
    searchable: {
      type: Boolean,
      default: true,
    },
    hasChild: {
      type: Boolean,
      default: false,
    },
    paginated: {
      type: Boolean,
      default: true,
    },
    //
    perPage: {
      type: Number,
      default: 10,
    },
    currentPage: {
      type: Number,
      default: 1,
    },
    lastPage: {
      type: Number,
      default: 1,
    },
    total: {
      type: Number,
      default: 0,
    },
    sortBy: {
      type: String,
      default: '',
    },
    sortDir: {
      type: String,
      default: 'desc',
    },
  },

  data() {
    return {
      keyword: '',
      perPages: [10, 25, 50, 100],
      shownChildren: [],
    };
  },

  watch: {
    keyword() {
      this.search();
    },
  },

  methods: {
    search: debounce(function () {
      this.$emit('search', this.keyword);
    }, 500),
    setBorder() {
      return !this.border ? 'border-0' : '';
    },
    setShadow() {
      return this.shadow ? 'shadow-1' : '';
    },
    setClass(item) {
      return {
        'text-right': item.align === 'right',
        'text-center': item.align === 'center',
      };
    },
    sort(name) {
      const dir = this.sortDir === 'asc' ? 'desc' : 'asc';
      this.$emit('sort-by', name);
      this.$emit('sort-dir', dir);
    },
    toPage(page) {
      this.$emit('to-page', page);
    },
    onPerPage(evt) {
      this.$emit('per-page', parseInt(evt.target.value));
    },
    toggleChild(index) {
      const shownIndex = this.getChildShownIndex(index);
      if (shownIndex < 0) {
        this.shownChildren.push(index);
      } else {
        this.shownChildren.splice(shownIndex, 1);
      }
    },
    getChildShownIndex(index) {
      return this.shownChildren.indexOf(index);
    },
  },
};
</script>
