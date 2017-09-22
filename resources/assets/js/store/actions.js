function make (type) {
  return ({ commit }, ...args) => commit(type, ...args)
}

export default {
  toggleExample: make('TOGGLE_EXAMPLE')
}
