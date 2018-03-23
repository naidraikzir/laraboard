import axios from 'axios';

const instance = axios.create({
  timeout: 20000,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
  },
});

export default instance;
