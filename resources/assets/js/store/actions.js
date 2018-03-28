function make(type) {
  return ({ commit }, ...args) => commit(type, ...args);
}

export default {
  addAlert: make('ADD_ALERT'),
};
