<template>
    <div class="d-flex flex-column pt-5">
        <div v-if="loading">
            Just a moment, files are uploading....
        </div>
        <div v-else-if="!dettail" class="d-flex flex-column align-items-center pt-5">
            <h1 class="pb-4">I miei Post</h1>
            <IndexPostsComponent v-if="!dettail" @requestPage="loadPage" :postsobject='posts' @showPost='showDettails'/>
        </div>
        <div v-else class="d-flex flex-column align-items-center">
            Al momento non sono presenti file da visualizzare
        </div>
    </div>
  </template>

  <script>

    import IndexPostsComponent from '../components/IndexPostsComponent.vue'
  export default {
  name:'PostsComponent',
  components:{
    IndexPostsComponent,

  },
  data(){
     return {

        posts:undefined,
        errorMessage:'',
        loading: true,
        dettail: undefined,
        categories:undefined,
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
      }).catch((e)=>{
        console.log(e);
      })
    },
    showDettails(id){
        console.log(id)
    },

  },
  mounted(){
        const page = this.$route.query.page? this.$route.query.page : 1;
        this.loadPage('api/posts?page=' + page)
  }
  }
  </script>
