

<script>
    export default {
        props: ['propsupplier'],
        data(){
            return {
                comments:[],
                new_comment:'comment me baby'
                supplier: this.propsupplier
            }
        },
        created() {
        },
        mounted(){
        },
        methods: {
            // addTodo() {
            //     this.newtodo = this.todo;
            //     this.todo = {id: null, title: '', completed: false};
            // }
        }
  
    }

</script>


<template>
    <div class="purchase">



    <!--     <form method="POST" v-on:submit.prevent="submit" :action="post_url">
            <textarea v-model="new_comment" name="comment" placeholder="New Comment..."></textarea>
            <input type="submit"/>
        </form> --> -->

    </div>
</template>
