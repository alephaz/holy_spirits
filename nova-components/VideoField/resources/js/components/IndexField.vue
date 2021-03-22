<template>
    <p>
        <a v-bind:href="field.value" target="_blank">
            <img v-bind:src="videoUrl"
                 class="rounded-full w-10 h-10" style="object-fit: cover;">
        </a>
    </p>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],
        computed: {
            videoUrl() {
                if (this.field.value && this.field.value) {
                    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                    var match = this.field.value.match(regExp);
                    return (match && match[7].length == 11) ? "https://img.youtube.com/vi/" + match[7] + "/default.jpg" : false;
                }
            }
        }
    }
</script>
