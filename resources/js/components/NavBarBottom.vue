<template>
<div class="row bg-light text-primary">
  <div class="col-md-3">
    <img src="../assets/logo_full_blue.png" height="250px" width="250px" class="img-fluid" alt="logo">
  </div>
  <div class="col-md-9">
    <div class="d-flex bg-light">
  <div class="p-2 flex-fill text-center">
    Found Items<br>
    <font-awesome-layers full-width class="fa-3x">
      <font-awesome-icon class="fa-primary" icon="certificate"/>
      <font-awesome-layers-text 
            class="fa-inverse" 
            transform="shrink-11.5 rotate--30" 
            value="256" 
            style="font-weight:900"/>
    </font-awesome-layers>
  </div>

  <div class="p-2 flex-fill text-center ">
      75<br>
      Returned Items
      <br>
      <font-awesome-icon class="primary fa-2x" icon="handshake"/>
  </div>

  <div class="p-2 flex-fill text-center">
    <router-link to="/create-report">
      Report an Item<br>
      <font-awesome-icon class="primary fa-2x" icon="bullhorn"/>
    </router-link>
  </div>
</div>
  </div>
</div>

</template>
 