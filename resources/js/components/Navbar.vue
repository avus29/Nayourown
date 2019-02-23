<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <router-link class="navbar-brand" to="/">
    <img src="../assets/logo.png" height="70px" width="70px" class="img-fluid" alt="logo">
  </router-link>
  
    <!-- Left side of the navbar -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link to="/" class="nav-link">Home</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/about" class="nav-link">About</router-link>
      </li>

        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Find a lost item">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>     

    </ul>
  </div>
    <!-- Right side of the navbar -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <router-link to="/login" class="nav-link" v-if="!authUser">Login</router-link>
      </li>

      <li class="nav-item">
        <router-link to="/register" class="nav-link" v-if="!authUser">Register</router-link>
      </li>
      
     <li class="nav-item dropdown" v-if="authUser">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <font-awesome-icon  icon="user-alt"/> {{authUser.name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" @click="logout()" href="#">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

</template>
 
 <script>
 export default {
   computed: {
    authUser(){
      return this.$root.auth.token? this.$root.auth : '';
    },
   }, 

   methods: {
      logout(){
         this.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.authUser.token;
        this.axios.get('/api/auth/logout')
        .then((response)=>{
          localStorage.removeItem('auth');
          this.$root.auth = '';
          this.$noty.success("Logged out successfully.");
          this.$router.push('/');
        })
        .catch((error)=>{
          console.log(error);
          localStorage.removeItem('auth');
          this.$root.auth = '';
          this.$noty.error("Oops! An error occured while trying to log you out...");
          this.$router.push('/');
        });
    }
   }
 }
 </script>
 