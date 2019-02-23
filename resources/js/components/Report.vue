<template>
    <div class="card mb-3">
        <img class="card-img-top bg-light" src="../assets/logo.png" width="10%" height="10%" alt="">
        <div class="card-body">
            <h6 class="card-title">{{report.title}}</h6>
            <p class="card-text" >{{report.description.substring(0,50)}}</p>
             <router-link :to="report.url" class="btn btn-primary">Read more...</router-link>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'report',
    ],

     data(){
        return{
            

        }
    },
}
</script>

