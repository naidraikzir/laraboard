import axios from 'axios';
import router from 'js/router';
import store from 'js/store';

const instance = axios.create({
  baseURL: '/dashboard/',
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
    } else if (err.response.status === 403) {
      router.push({ path: '/' });
      store.commit('ADD_ALERT', {
        type: 'danger',
        message: err.response.data.message,
      });
    } else if (err.response.status === 404) {
      router.push({ path: '/404' });
      store.commit('ADD_ALERT', {
        type: 'danger',
        message: err.response.data,
      });
    }

    return Promise.reject(err);
  },
);

export default instance;
