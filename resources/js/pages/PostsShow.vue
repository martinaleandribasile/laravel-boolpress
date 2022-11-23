<template>
  <div class="text-center pt-5">
        <div v-if="loading">Loading page...</div>
        <div v-else>
            <h1 class="mb-4">Post</h1>
            <div>
                    <h2 class="text-info">Title:</h2>
                    <h3>{{post.title}}</h3>
            </div>
            <div>
                    <h2 class="text-info">Content:</h2>
                    <h3>{{post.content}}</h3>
            </div>
            <div >
                    <h2 class="text-info">Category:</h2>
                    <h3 v-if="post.category">{{post.category.name}}</h3>
                    <h6 v-else> Non ci sono categoria sssociate </h6>
            </div>
            <div v-if="post.cover_path">
                    <h2 class="text-info">Cover:</h2>
                    <img :src="`storage/${post.cover_path}`" alt="">
            </div>
            <div>
                <h2 class="text-info">Tags:</h2>
                <div v-if="post.tags.length > 0">
                    <div v-for="tag in post.tags" :key="tag.id">
                        <h6>{{tag.name}}</h6>
                    </div>
                </div>
                <div v-else>
                    <p>Non ci sono tag associati</p>
                </div>
            </div>
        </div>

        <div class="my-5">
            <!--   RITORNA LA PAGINA INIZIALE DEL NOSTRO BLOG, NON QUELLA DA DOVE ABBIAMO CLICCATO IL DETTAGLIO router-link class="btn btn-success " :to="{name:'posts-index'}">BLOG</!--router-link-->
            <button class="btn btn-danger" @click="backList()">Return to Blog</button>
        </div>
    </div>
</template>

<script>
export default {
name: 'PostsShow',
data(){
    return{
        post:undefined,
        loading:true,
        prevUrl:'',
    }
},
methods:{
    loadPage(url){
        axios.get(url).then(({data})=>{
        if(data.success){
            console.log(data.results)
            this.post= data.results
        }else{
           // this.errorMessage = data.error
            this.$router.push({name: 'NotFound'}) // altro metodo per reindirizzare le rotte del router attraverso il nome della rotta
        }
        this.loading = false
      }).catch((e)=>{
        console.log(e);
      })
    },
    backList(){
        console.log(this.$router)
        this.$router.push(this.prevUrl); // in questo caso non andiamo in dietro nella history ma aggiungiamo invece url alla nostra history
       // this.$router.go(-1); // reindirizza la pagina all url precedente -. si basa sulla history della navigazione

    }
},
mounted(){
    const id = this.$route.params.id; // metodo predefinito da VueRouter
    this.loadPage('api/posts/' +id);

    /* CON LO SLUG   const slug = this.$route.params.slug;
    this.loadPage('api/posts/' +slug);*/
},
// Funzione standard -> beforeRouteEnter -> possiam ocondizionare l accesso alla rotta in cui viene chiamata -> per poi entrare realmente devo chiamare il metodo next();
beforeRouteEnter(to,from,next){
    console.log(to,from); // qiesti parametri hanno informazioni sulle rotte da cui proveniamo e della rotta in cui ci troviamo (noi per il momento non abbiamo usato next)
    next(vm=>{
        console.log('vm', vm) // -> rappresenta la vue dove sto chiamando la fx (VueComponent in console)
        vm.prevUrl = from.name? from.fullPath : '/posts'; // -> creo una proprieta' di vm chiamata come il mio data -> e gli do come valore una proprieta' di from che e' fullPath che ha come valore l url da cui provengo
    });
},
beforeRouteLeave (to, from, next) {
const answer = window.confirm('Do you really want to leave? ')
if (answer) {
    next()
} else {

}
}
}

</script>

<style lang="scss" scoped>

</style>





