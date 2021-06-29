
 <template>
    <a href="">
        <p class="text-primary font-weight-bold cursor" @click="followUser" v-text="buttonText"></p>
    </a>
</template>

<script>
    export default {
        props:["username","follows"],

        mounted() {
            console.log('Component mounted.');
        },
        data:function (){
            return {status: this.follows,}
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
           /* if(this.status){
                return "Unfollow";
            }else {
              return   "Follow";
            }
            // same as
            */
              return (this.status) ? "Unfollow" : "Follow";
        }
    }
}
</script>
