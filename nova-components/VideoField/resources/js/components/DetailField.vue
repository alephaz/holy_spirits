<template>
    <!--<panel-item :field="field"></panel-item>-->
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">
                Video
            </h4>
        </div>
        <div class="w-3/4 py-4">
            <p class="py-3">{{ field.value }}</p>
            <youtube :video-id="videoUrl" ref="youtube"></youtube>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        computed: {
            videoUrl() {
                if (this.field.value && this.field.value) {
                    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                    var match = this.field.value.match(regExp);
                    return (match && match[7].length == 11) ? match[7] : false;
                }
            }
        }
    }
</script>
