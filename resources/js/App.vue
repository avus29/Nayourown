<template>
    <div class="container-fluid">
        <navbar></navbar>
        <navbar-bottom></navbar-bottom>

        <div class="row my-2">
            <!-- Left Panel goes here to display Categories and possibly some adds -->
            <div class="col-md-2">
                <left-panel></left-panel>
            </div>
            <!-- Main Panel for the SPA... All other pages load in this div -->
            <div class="col-md-7">
                <transition name="fade" enter-active-class="fadeInLeft" leave-active-class="fadeOutRight" mode="out-in">
                    <router-view></router-view>
                </transition>
            </div>
             <!-- Right Panel goes here to display Chronology and Meta tags and possibly some adds -->
            <div class="col-md-3">
                <right-panel></right-panel>
            </div>
        </div>

        <page-footer></page-footer>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import NavbarBottom from './components/NavbarBottom.vue'
import PageFooter from './components/PageFooter.vue'
import LeftPanel from './components/LeftPanel.vue'
import RightPanel from './components/RightPanel.vue'


export default {
    data(){
        return{
            
        }
    },

    components: {
        Navbar, NavbarBottom, PageFooter, LeftPanel, RightPanel,
    }
    
}
</script>

<style>
body{
    background-color: lightgoldenrodyellow;
}
</style>

