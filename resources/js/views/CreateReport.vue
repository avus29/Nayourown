<template>
<div class="row">
    <div class="col-md-12 my-1">
        <div class="card bg-light">
            <div class="card-header bg-dark text-light text-center"><h5>Report a  found item </h5></div>
            <div class="card-body ">
                <form @submit.prevent="validateInputs()">
                    <div class="form-group">
                    <label for="category">Pick a category for the found item:</label>
                    <select v-validate="'required'" class="form-control" v-model="category_id" name="category" >
                        <option value="1">Electronics</option>
                        <option value="2">Documents</option>
                        <option value="3">Personal Effects</option>
                    </select>
                     <span>{{ errors.first('category') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input v-validate="'required|min:15'" type="text" v-model="title" class="form-control" name="title" id="title" placeholder="Give a title to the found item...">
                         <span>{{ errors.first('title') }}</span>
                    </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea v-validate="'required|min:100'" v-model="description" class="form-control" name="description" rows="5" placeholder="Describe the found item in details..."></textarea> 
                            <span>{{ errors.first('description') }}</span>               
                        </div>

                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input v-validate="'required|min:3'" v-model="location" type="text" name="location" id="" class="form-control" placeholder="Where did you find this item?" >
                        <span>{{ errors.first('location') }}</span>  
                    </div>

                    

                    <div class="form-group">
                        <label for="date_found">Date Found:</label>
                        <input v-validate="'required'" v-model="dateFound" class="form-control" type="date" name="date_found" >
                        <span>{{ errors.first('date_found') }}</span>  
                    </div>             
                        
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-dark">
                            <font-awesome-icon v-if="loading" icon="spinner" spin/>
                            {{loading? '':'Report Item'}}
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div> 
</template>

<script>
export default {
     beforeRouteEnter(to, from, next){
        if(!localStorage.getItem('auth')){
            return next({path: "/login"})
        }
        next();
    },
    data(){
        return{
            title: '',
            description: '',
            location: '',
            date_found: '',
            category_id: '',

            loading: false,
            
        }
    },
    
    methods: {
        validateInputs(){
             this.$validator.validateAll().then(result => {
                if (result) {
                    this.createReport();
                }else{
                    this.$noty.error('Kindly fill the highlighted fields...');
                    return;
                }
            });
        },        
        createReport(){
            this.loading = true;
            this.axios.defaults.headers.common['Authorization'] = 'Bearer '+this.$root.auth.token;
            this.axios.post('/api/reports',{
                category_id: this.category_id,
                title: this.title,
                description: this.description,
                // date_found: this.date_found,
                // location: this.location
            })
            .then((response)=>{
                this.loading = false;
                this.$noty.success(response.data);
                this.$router.push('/');
            })
            .catch((error)=>{
                this.loading = false;
                this.$noty.error('Oops!..An error occurred while submitting report, please try again.');                
            })
        }
    }
}
</script>
