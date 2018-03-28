export default {
  ADD_ALERT(state, newAlert) {
    const alert = JSON.parse(JSON.stringify(newAlert));
    const newId = state.alerts.length + 1;
    alert.id = newId;
    state.alerts.push(alert);
    setTimeout(() => {
      state.alerts.splice(
        state.alerts.map(({ id }) => id).indexOf(newId),
        1,
      );
    }, 5000);
  },
};
