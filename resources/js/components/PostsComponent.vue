<template>
    <div class="d-flex flex-column pt-5">
        <div v-if="loading">
            Just a moment, files are uploading....
        </div>
        <div v-else-if="!dettail" class="d-flex flex-column align-items-center pt-5">
            <h1 class="pb-4">I miei Post</h1>
            <IndexPostsComponent v-if="!dettail" @requestPage="loadPage" :postsobject='posts' @showPost='showDettails'/>
        </div>
        <div v-else-if="dettail" class="p-5 d-flex flex-column">
            <DettailPostComponent :post='dettail'/>
            <button class="btn btn-danger my-5" @click="dettail = undefined">Back to List</button>
        </div>
        <div v-else class="d-flex flex-column align-items-center">
            Al momento non sono presenti file da visualizzare
        </div>
    </div>
  </template>

  <script>

import IndexPostsComponent from './IndexPostsComponent.vue'
import DettailPostComponent from './DettailComponent.vue'
  export default {
  name:'PostsComponent',
  components:{
    IndexPostsComponent,
    DettailPostComponent
  },
  data(){
     return {

        posts:undefined,
        errorMessage:'',
        loading: true,
        dettail: undefined,
      }
  },
  methods:{
    loadPage(url){
        axios.get(url).then(({data})=>{
        if(data.success){
            console.log(data.results)
            this.posts= data.results
        }else{
            this.errorMessage = data.error
        }
        this.loading = false
      })
    },
    showDettails(id){
        this.loading=true;
        axios.get('/api/posts/' +id)
        .then(response=>{
            this.dettail = response.data.success? response.data.results : undefined;
            this.loading=false;
            console.log(this.dettail)
        }).catch(e=>{
            console.log(e);
            this.loading = false;
        })
    }
  },
  mounted(){
      this.loadPage('api/posts')
  }

  }
  </script>

  <style lang="scss" scoped>
        button{
            width: 300px;
        }
  </style>

