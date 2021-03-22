<template>
    <field-wrapper>
        <div class="w-1/5 px-8 py-6">
            <slot>
                <form-label :for="field.name">
                    {{ field.name }}
                </form-label>
            </slot>
        </div>
        <div class="px-8 py-6" :class="computedWidth">
            <a
                    class="inline-block font-bold cursor-pointer mr-2 animate-text-color select-none border-primary"
                    :class="{ 'text-60': localeKey !== currentLocale, 'text-primary border-b-2': localeKey === currentLocale }"
                    :key="`a-${localeKey}`"
                    v-for="(locale, localeKey) in field.locales"
                    @click="changeTab(localeKey)"
            >
                {{ locale }}
            </a>

            <textarea
                    ref="field"
                    :id="field.name"
                    class="mt-4 w-full form-control form-input form-input-bordered py-3 min-h-textarea"
                    :class="errorClasses"
                    :placeholder="field.name"
                    v-model="value[currentLocale]"
                    v-if="!field.singleLine && !field.ckeditor"
                    @keydown.tab="handleTab"></textarea>

            <div v-if="!field.singleField && field.ckeditor" class="mt-4">
                <vue-ckeditor ref="field"
                              v-model="value[currentLocale]"
                              :id="field.name"
                              :class="errorClasses"
                              :name="field.name"
                              :placeholder="field.name"
                              :config="config"
                              @keydown.tab="handleTab"/>
            </div>

            <input
                    ref="field"
                    type="text"
                    :id="field.name"
                    class="mt-4 w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="field.name"
                    v-model="value[currentLocale]"
                    v-if="field.singleLine"
                    @keydown.tab="handleTab"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </div>
    </field-wrapper>
</template>

<script>


    import VueCkeditor from 'vue-ckeditor2';

    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        components: {VueCkeditor},

        data() {
            return {
                locales: Object.keys(this.field.locales),
                currentLocale: null,
                config: {
                    toolbar: [
                        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
                        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
                        '/',
                        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                        '/',
                        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                        { name: 'others', items: [ '-' ] },
                        { name: 'about', items: [ 'About' ] }
                    ],
                    height: 300
                }
            }
        },

        mounted() {
            this.currentLocale = this.locales[0] || null;

            // update ckeditor config
            for (let instance in CKEDITOR.instances) {
                if (instance === this.field.name) {
                    CKEDITOR.instances[instance].config.allowedContent = true;;
                }
            }
        },

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || {}
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                Object.keys(this.value).forEach(locale => {
                    formData.append(this.field.attribute + '[' + locale + ']', this.value[locale] || '')
                })
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value[this.currentLocale] = value
            },

            changeTab(locale) {

                this.currentLocale = locale;

                for (let instance in CKEDITOR.instances) {
                    if (instance === this.field.name) {
                        CKEDITOR.instances[instance].setData(this.value[locale] ? this.value[locale] : '');
                        CKEDITOR.instances[instance].config.allowedContent = true;
                    }
                }
                this.$nextTick(() => {
                    if (!this.field.ckeditor) {
                        this.$refs.field.focus()
                    }
                })
            },

            handleTab(e) {
                const currentIndex = this.locales.indexOf(this.currentLocale)
                if (!e.shiftKey) {
                    if (currentIndex < this.locales.length - 1) {
                        e.preventDefault()
                        this.changeTab(this.locales[currentIndex + 1])
                    }
                } else {
                    if (currentIndex > 0) {
                        e.preventDefault()
                        this.changeTab(this.locales[currentIndex - 1])
                    }
                }
            }
        },

        computed: {
            computedWidth() {
                return {
                    'w-1/2': !this.field.ckeditor,
                    'w-4/5': this.field.ckeditor
                }
            }
        }
    }
</script>
