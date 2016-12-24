<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                       @{{ title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'chat',
        data(){
            return{
                title: 'Hello Component'
            }

        },
        method{
            submit: function(){
                alert('test component alert');
            }
        }

        // mounted() {
        //     console.log('Component ready.')
        // }
    }
</script>
