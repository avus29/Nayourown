<template>
<div>

    <div class="row" v-if="!loading">
        <div class="col-md-4" v-for="report in reports" :key="report.id">
            <report :report="report"></report>
        </div>
    </div>
    
    <div class="loader text-center" v-else>
        <font-awesome-icon icon="spinner" spin/>
    </div>
    <!-- Paginations... -->
    <nav aria-label="Page navigation my-50">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <button class="btn btn-primary text-light" :disabled="pagination.prev_page===null" @click="getReports(pagination.prev_page)">
            <span >&laquo;</span>
            <span >Prev</span>
          </button>
        </li>

        <li class="page-item">
            <a class="page-link disabled text-primary">
                <b>page {{pagination.current_page}} of {{pagination.last_page}}</b>
            </a>
        </li>
        
        <li class="page-item">
          <button class="btn btn-primary text-light" :disabled="pagination.next_page===null" @click="getReports(pagination.next_page)">
             <span>Next</span>
             <span >&raquo;</span>
            
          </button>
        </li>
      </ul>
    </nav>
    
</div>
</template>

<script>
import Report from '../components/Report.vue'

export default {
    data(){
        return{
            reports: {},
            pagination: {},
            loading: false,
        }
    },

    mounted(){
        this.getReports();
    },

    components: {
        Report,
    },

    methods: {
        getReports(url = 'http://nayourown.com/api/reports'){
            this.loading = true;
            this.axios.get(url)
            .then((res) => {
                this.loading = false;
                this.reports = res.data.data
                this.makePagination(res.data.links, res.data.meta);
               
            }).
            catch((response) =>{
                this.loading = false;
                console.log('error occured');
            });
        },

        makePagination(links, meta){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page: links.next,
                prev_page: links.prev
            }
            this.pagination = pagination;
        }

       
    },
    
}
</script>

