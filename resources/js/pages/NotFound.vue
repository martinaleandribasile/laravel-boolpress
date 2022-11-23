<template>
    <div class="d-flex flex-column align-items-center py-5">
      <h2>ERROR</h2>
      <H4>Not found the page</H4>
      <router-link to="/">Home</router-link>
      <!-- <router-link :to="{name: 'Home'}">   altro modo utilizzando la proprieta'name-->
    </div>
  </template>

  <script>
  export default {
  name:'NotFoundComponent'
  }
  </script>

  <style>

  </style>
