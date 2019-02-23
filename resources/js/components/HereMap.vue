<template>
    <div class="here-map">
        <div ref="map" v-bind:style="{ width: width, height: height }"></div>
    </div>
</template>

<script>
    export default {
        name: "HereMap",
        data() {
            return {
                map: {},
                platform: {},
                 geocoder: {}
            }
        },

        created() {
            this.platform = new H.service.Platform({
                "app_id": this.appId,
                "app_code": this.appCode
            });

            this.geocoder = this.platform.getGeocodingService();
        },

        mounted() {
            this.map = new H.Map(
                this.$refs.map,
                this.platform.createDefaultLayers().normal.map,
                {
                    zoom: 14,
                    center: { lng: this.lng, lat: this.lat }
                }
            );

            // this.map.addObject(new H.map.Marker({lat: this.lat, lng: this.lng }));

            this.geocoder.geocode({ searchText: this.location }, data => {
                if(data.Response.View.length > 0) {
                    if(data.Response.View[0].Result.length > 0) {
                        var coords = data.Response.View[0].Result[0].Location.DisplayPosition;
                        this.map.setCenter({lat: coords.Latitude, lng: coords.Longitude });
                        this.map.addObject(new H.map.Marker({lat: coords.Latitude, lng: coords.Longitude }));
                    }
                }
            }, error => {
                console.error(error);
            });
        },

        props: {
            appId: String,
            appCode: String,
            lat: String,
            lng: String,
            width: String,
            height: String,
            location: String,
        },
    }
</script>

<style scoped>

</style>