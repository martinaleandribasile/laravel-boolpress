<template>
    <div class="d-flex align-items-center">
        <ul class="d-flex justify-content-between mx-auto">
            <li v-for="link,index in nav" :key="index">
                <router-link :to="link.path">{{link.name}}</router-link>
            </li>
        </ul>
    </div>
    </template>

    <script>
    export default {
    name:'NavComponent',
    props:{
        nav:Array,
    }
    }
    </script>

    <style lang="scss" scoped>
       div{
        height: 100px;
        background-color: cornflowerblue;
        ul{
           margin: 0;
            width: 80%;
            list-style: none;
            a{
                color:white!important
            }
        }
       }
    </style>
