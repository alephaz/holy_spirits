<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="flex">
                <div class="w-1/2 pr-2">
                    <input :id="field.name" type="text"
                           class="w-full form-control form-input form-input-bordered"
                           :class="errorClasses"
                           :placeholder="field.name"
                           v-model="value"
                    />
                </div>

                <div class="w-1/2" v-if="videoUrl">
                    <youtube :video-id="videoUrl" ref="youtube" @playing="playing"></youtube>
                </div>
            </div>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                videoId: '6DrNC-xQcGs',
                playing: false,
                value: ''
            };
        },

        computed: {
            videoUrl() {
                if (this.value && this.value.length) {
                    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                    var match = this.value.match(regExp);
                    return (match && match[7].length == 11) ? match[7] : false;
                }
            }
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
            },
        },
    }
</script>
