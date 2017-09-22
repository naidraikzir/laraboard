<template lang="pug">
.row.justify-content-center
  .mt-5
    h1 Oops...!
    h4 Not found
    router-link(:to="{ path: '/dashboard' }") Back
</template>
