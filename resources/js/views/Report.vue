<template>
<div>
    <div v-if="!loading" class="card">

        <div class="card-header">
            <h5>{{report.title}}</h5>
        </div>

        <div class="card-body">
            <div class="row">
            
                <div class="col-md-5" >
                    <div class="card text-white bg-dark">
                    <img class="card-img-top" src="../assets/logo_white.png" alt="">
                    <div class="card-body">
                        <p class="card-text">Reported on: 29/05/1998</p>
                    </div>
                    </div>
                </div>

                <div class="col-md-7" >
                    <table class="table table-striped">
                            <tbody>
                                <tr >
                                    <td >Reported on:</td>
                                    <td>{{report.reported_on.date}}</td>
                                </tr>
                                <tr>
                                    <td >Category:</td>
                                    <td>{{report.category}}</td>
                                </tr>
                                <tr>
                                    <td >Found at:</td>
                                    <td>Oda road, Akure</td>
                                </tr>
                                <tr>
                                    <td >Description:</td>
                                    <td>{{report.description}}</td>
                                </tr>
                            </tbody>
                    </table>
                </div>

                <div class="col-md-8 offset-md-2 text-center">
                    <button type="button" class="btn btn-success">Claim this Item</button>
                </div>
            </div>
        </div>

    </div>

    <div v-else class="loader text-center">
        <font-awesome-icon icon="spinner" spin/>
    </div>
</div>

</template>

<script>
export default {
    data(){
        return{
            report: {},
            loading: true,
        }
    },

    mounted() {
        this.getReport();
    },

    methods: {
        getReport(){
            this.axios.get(`/api/reports/${this.$route.params.slug}/${this.$route.params.id}`)
            .then((res)=> {
                this.loading = false;
                this.report = res.data.data;
        
            })
            .catch((error)=>{
                this.loading = false;
                this.$noty.error('Oops!... An error ocured while trying to load the report. Please try again.')
            });
        }
    }
    
}
</script>
