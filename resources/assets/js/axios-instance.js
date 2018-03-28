import axios from 'axios';

const instance = axios.create({
  timeout: 20000,
  headers: {
    'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('content'),
    'X-Requested-With': 'XMLHttpRequest',
  },
});

instance.interceptors.response.use(
  response => response,
  (err) => {
    if ([401, 419].indexOf(err.response.status) > -1) {
      window.location.reload();
    }

    return Promise.reject(err);
  },
);

export default instance;
