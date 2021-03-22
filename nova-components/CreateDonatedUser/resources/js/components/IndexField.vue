<template>
    <div>
        <button class="btn btn-default btn-primary"
                v-if="!isDonatedUserHasAccount"
                @click="createDonatedUser">Create User
        </button>
        <div class="text-center text-center" v-if="isDonatedUserHasAccount">
            <span class="inline-block rounded-full w-2 h-2 bg-success"></span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],
        data() {
            return {
                isDonatedUserHasAccount: false,
                donation: null
            };
        },
        methods: {
            createDonatedUser: function () {
                axios.post('/create-donated-user', this.donation).then((response) => {

                    if (response.status === 200, response.data.status) {

                        this.$toasted.show('User created', {type: 'success'});

                        this.isDonatedUserHasAccount = true;
                    }
                });
            }
        },
        mounted() {

            // check if the user email dose not have an user account
            if (this.field.isDonatedUserHasAccount) {
                this.isDonatedUserHasAccount = this.field.isDonatedUserHasAccount;
            }

            // check if there is a donation model set to the button
            if (this.field.donation) {
                this.donation = this.field.donation;
            }
        }
    }
</script>
