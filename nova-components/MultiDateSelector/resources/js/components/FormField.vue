<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <flat-pickr :id="field.name"
                        :class="errorClasses"
                        :placeholder="field.name"
                        :config="config"
                        v-model="value"
                        class="w-full form-control form-input form-input-bordered"></flat-pickr>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'
    import flatPickr from 'vue-flatpickr-component';


    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                config: {
                    mode: "multiple",
                    dateFormat : this.field.format
                }
            };
        },

        components: {
            flatPickr
        },

        methods: {

            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || ''
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        },
    }
</script>
