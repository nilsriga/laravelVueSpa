<template>
    <div class="message">

        <div class="message-header">

            Push to the Stream..

        </div>

        <div class="message-body">

            <form @submit.prevent="onSubmit" v-on:keydown="form.errors.clear($event.target.name)">

                <p class="control">

                    <textarea name="body" v-model="form.body" class="textarea" placeholder="I have something to say.."></textarea>

                </p>

                <span 
                    v-if="form.errors.has('body')" 
                    v-text="form.errors.get('body')" 
                    class="help is-danger">
                </span>

                <p class="control">

                    <button :disabled="form.errors.any()"  class="button is-primary">Post</button>

                </p>

            </form>

        </div>

    </div>
</template>

<script>
export default {

    data() {

        return {

            form: new Form( {body: '' }),  

        }

    },

    methods: {

        onSubmit() {

            this.form
                .post('/statuses',)
                .then(status => this.$emit('completed', status))
                .catch(errors => console.log(errors.errors));
        },
    },
}
</script>
