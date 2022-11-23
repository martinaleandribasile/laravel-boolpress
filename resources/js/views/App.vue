<template>
    <div>
        <NavComponent :nav='nav'/>
        <router-view></router-view> <!--va a visualizzarmi PostsIndex in quanto e' la pagina collegata al path ? -->
    </div>
    </template>

    <script>
    import NavComponent from '../components/NavComponent.vue';


    export default {
        name: "App",
        components: { NavComponent },
        data(){
            return{
                nav:[
                    {
                        path: '/',
                        name:'Home'
                    },
                    {
                        path: '/posts',
                        name:'Blog'
                    },
                    {
                        path: '/about',
                        name:'About'
                    },
                    {
                        path: '/contacts',
                        name:'Contatti'
                    },
                ]
            }
        }

    }
    </script>



