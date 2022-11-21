<template>
  <div >
    <h1 class="mb-4">Post</h1>
       <div>
            <h2 class="text-info">Title:</h2>
            <h3>{{post.title}}</h3>
       </div>
       <div>
            <h2 class="text-info">Content:</h2>
            <h3>{{post.content}}</h3>
       </div>
       <div v-if="post.category_id != undefined">
            <h2 class="text-info">Categoria:</h2>
            <h3 >{{post.category_id}}</h3>
       </div>
  </div>
</template>

<script>
export default {
name: 'DettailPostComponent',
props:{
    post:Object
}
}
</script>

<style>

</style>
