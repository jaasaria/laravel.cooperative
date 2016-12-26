

<script>


    export default {
        props: ['newtodo'],
        created() {

        },
        mounted(){

            // console.log('mounted waiting for pusher - echo 1234');

            Echo.channel('jaasaria_channel')
            .listen('ChatMessageReceived', (e) => {
                console.log('tests logging receive from pusher');
            });


            // console.log('end of pusher echo');

               // Echo.private('comments.'+self.post_id)
               //  .listen('NewComment', (e) => {
               //      self.comments.push(e.comment);
               //  });

                    

        }

    }

</script>


<template>
    <div class="comments">
        <h2>Comments 1</h2>

      <!--   <h2>{{ new_comment }}</h2>
        <h2>{{ comments_url }}</h2> -->

       <!--  <div v-for="comment in comments" class="comment">
            <h5>{{ comment.username }} said:</h5>
            <p>{{ comment.comment }}</p>
        </div> -->
<!-- 
        <form method="POST" v-on:submit.prevent="submit" :action="post_url">
            <textarea v-model="new_comment" name="comment" placeholder="New Comment..."></textarea>
            <input type="submit"/>
        </form> -->


    </div>
</template>

<!-- 
<script>
    // var Vue = require('vue');

    //  export default {
    //     mounted() {
    //         console.log('Component ready.')
    //     }
    // }

    export default {
        data(){
            return {
                comments:[],
                new_comment:'comment me baby'
            }
        },
        created () {
              console.log('created');
        },
        ready:function(){
            console.log('this');
            alert('123');
        },
        mounted(){
            var self = this;

            alert('1234');

            console.log('console logs comment');
            // console.log(this.comments_url);

            Vue.http.get('allmessage').then((response) => {
                _.forEach(response.data,function(item){
                    self.comments.push(item);
                })
            })

            Echo.private('jaasaria_channel')
                .listen('ChatMessageReceived', (e) => {
                    self.comments.push(e.comment);
                });

        }
    }
</script>
 -->