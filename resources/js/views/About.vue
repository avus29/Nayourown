<template>
    <div>
         <HereMap
            appId="NpLwJvzTlohLEfnVcS7u"
            appCode="ezDp2_b0BF21u9WP8IEFXg"
            lat=""
            lng=""
            location="Alagbaka Akure"
            width="100%"
            height="400px" />
    </div>
</template>


<script>
import HereMap from "../components/HereMap.vue"

export default {

    components: {
        HereMap
    },

  methods: {
     
  }
}
</script>

<style>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
    }
</style>
