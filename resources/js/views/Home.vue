<template>
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="message" v-for="status in statuses" :key="status.id">
                    <div class="message-header">

                        <!-- <p>
                            {{status.user.name}} on {{status.browser}} said...
                        </p> -->
                        <p v-if="status.device != 0">
                            {{status.device}} from {{status.browser}} said...
                        </p>
                        
                        <p v-else>
                            {{status.browser}} said...
                        </p>
                        
                        <p>
                            {{status.created_at | ago | capitalize}}
                        </P>

                    </div>

                    <div class="message-body">
                        {{status.body}}
                    </div>

                    <!-- add to stream -->


                </div>

                <add-to-stream v-on:completed="addStatus"></add-to-stream>

            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import Status from '../models/Status';
    import AddToStream from '../components/AddToStream.vue'

    export default {
        data() {
            return {
                statuses: [],
            }
        },

        components: {
            AddToStream,
        },

        filters: {

            ago(date) {
                return moment(date).fromNow();
            },

            capitalize(value) {
                return value.toUpperCase();
            }
        },

        created() {
            Status.all(statuses => this.statuses = statuses);

            socket.on('post-channel:App\\Events\\PostSubmitted', function(data) {
                console.log(data.post);
                this.addStatus(data.post);
                
            }.bind(this))
            // this is the same
            // Status.all()
            //     .then(({data}) => this.statuses = data);
        },
        // .then(response => this.statuses = response.data); // this is the same

        methods: {
            // postedOn(status) {},

            addStatus(status) {

                this.statuses.unshift(status);


                window.scrollTo(0, 0);

            },
        },
    }

</script>
