<template>
    <div>
       <div>
           <ol >
               <li class="py-4" v-for="element in posts" :key="element.id">
                   {{element.title}}
                   <!-- @click='takeSlug(element.slug)'-->
                   <button @click="takeId(element.id)" class="btn btn-success mx-3">Dettails</button>
               </li>
           </ol>
       </div>
       <div class="d-flex justify-content-center align-items-center">
            <button class="btn btn-primary mx-3" :class="{disable: currentPage == 1}" @click="go(postsobject.first_page_url, 1)">Pagina Iniziale</button>
            <button :class="{disable: !postsobject.prev_page_url}" @click="go(postsobject.prev_page_url, currentPage -1)" class="btn btn-info mx-3">Previous</button>
            <p class="m-0">{{currentPage}}/{{lastPage}}</p>
            <button :class="{disable: !postsobject.next_page_url}" @click="go(postsobject.next_page_url, currentPage+1)" class="btn btn-info mx-3">Next</button>
            <button class="btn btn-primary mx-3" :class="{disable: currentPage == lastPage}" @click="go(postsobject.last_page_url, lastPage)">Ultima Pagina</button>
        </div>
    </div>
   </template>

   <script>


   export default {
   name:'IndexPostsComponent',
   computed:{
       posts(){
           return this.postsobject.data;
       },
       currentPage(){
           return this.postsobject.current_page;
       },
       lastPage(){
           return this.postsobject.last_page;
       }
   },
   props: {
       postsobject:Object
   },
   methods:{
       takeId(id){
           this.$emit('showPost', id)
       },
       go(url, pageNumber){
          if(url){
           this.$router.push({path: '/posts', query: {page : pageNumber}}) // per creare un aggiornamento visivo dell url alla pagina corrispondente a quella di paginazione dei post
           this.$emit('requestPage', url)
          }

       }
   }
   }

   </script>

   <style scoped lang="scss">
   button.disable{
       opacity: 0.5;
       pointer-events: none;
       cursor: none;

   }
   </style>
