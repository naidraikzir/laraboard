export default () => {
  const csrfEl = document.querySelector('[name=csrf-token]');
  return csrfEl ? csrfEl.getAttribute('content') : null;
};
