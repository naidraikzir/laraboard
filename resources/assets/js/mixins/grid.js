export default {
  data() {
    return {
      params: {
        page: 1,
        per_page: 10,
        sort_by: '',
        sort_dir: 'desc',
        keyword: '',
      },
      pagination: {
        current_page: 0,
        last_page: 0,
        total: 0,
      },
      loading: false,
    };
  },

  methods: {
    onToPage(page) {
      this.params.page = page;
    },
    onPerPage(perPage) {
      this.params.per_page = perPage;
    },
    onSortBy(by) {
      this.params.sort_by = by;
    },
    onSortDir(dir) {
      this.params.sort_dir = dir;
    },
    onSearch(keyword) {
      this.params.keyword = keyword;
    },
  },
};
