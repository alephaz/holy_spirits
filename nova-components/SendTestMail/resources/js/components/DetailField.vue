<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">
                Email
            </h4>
        </div>
        <div class="w-3/4 py-4">
            <input type="text" v-model="testMailAddress"
                   v-on:keyup.enter="sendTestMail()"
                   class="form-control form-input form-input-bordered"/>

            <div v-if="error">{{ error }}</div>

            <button class="btn btn-default btn-icon btn-white mr-3" @click="sendTestMail()">Send</button>

            <div v-if="successMessage">
                {{ successMessage }}
            </div>
            <br />
        </div>
    </div>
</template>

<script>

    import * as EmailValidator from 'email-validator';

    export default {

        props: ['resource', 'resourceName', 'resourceId', 'field'],

        data() {
            return {
                testMailAddress: null,
                error: false,
                successMessage: false
            };
        },

        mounted() {
            console.log(this.resourceId);
        },

        methods: {

            sendTestMail() {
                this.error = false;
                if (this.testMailAddress) {
                    if (EmailValidator.validate(this.testMailAddress)) {
                        axios
                            .get('/newsletter/test/' + this.resourceId + '/' + this.testMailAddress)
                            .then(function (response) {
                                if (response.status == 200 && response.data.status) {

                                    this.testMailAddress = null;

                                    this.successMessage = 'Mail send successfully'

                                    setTimeout(function () {
                                        this.successMessage = false;
                                    }.bind(this), 1000);

                                }
                            }.bind(this));
                    } else {
                        this.error = 'Sorry email address is not valid';
                    }
                } else {
                    this.error = 'Please type an email address to send the email';
                }
            }
        }
    }
</script>
