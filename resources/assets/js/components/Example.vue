<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component! bwisit1 123
                    </div>
                </div>

  

                <v-select :value.sync="selected" :options="options"></v-select>

            </div>
        </div>
    </div>
</template>

<script>

    // require("vue-select")
    // import vSelect from 'vue-select'


    export default {
        components: {vSelect},
        props: ['propsupplier'],
        data() {
            return {
                comments:[],
                new_comment:'comment me baby',
                option: this.propsupplier
            }

        },
        mounted() {
            console.log('Component ready.')
        }
    }
</script>
