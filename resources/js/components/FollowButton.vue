<template>
        <span v-bind:class="style" @click="followUser" v-text="buttonText"></span>
</template>

<script>
    export default {
        props:["username","follows","seen"],

        mounted() {
            console.log('Component mounted.');
        },
        data:function (){
            
            return {status: this.follows,
            seen: this.seen,}
        },
        methods:{
            followUser(){
              // axios for making http calls calls to the backend
               axios.post('/follow/'+ this.username)
                    .then(response => {
                        this.status = ! this.status;
                       console.log(response.data);
                    }).
                    catch(errors=>{
                    if(errors.response.status === 401){
                       window.location ="/login";
                    }
                })
            }
        }
    ,
    computed: {
        buttonText() {
              return (!this.status) ? "unfollow" :  "follow";
        },
        style(){
            return(!this.seen) ? "btn btn-primary ml-4" : "text-primary font-weight-bold cursor";
            }  
         }
}
</script>
