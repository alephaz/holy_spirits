<template>

    <div class="flex border-b border-40">
        <div class="w-1/4 py-4"><h4 class="font-normal text-80">
            {{ this.field.name }}
        </h4></div>
        <div class="w-3/4 py-4">
            <video-player v-if="this.field.value"
                          class="vjs-custom-skin"
                          ref="videoPlayer"
                          :options="playerOptions"
                          :playsinline="true"
                          @ready="playerReadied">
            </video-player>
            <span v-if="!this.field.value">No video file found</span>
        </div>
    </div>
</template>

<script>

    import 'video.js/dist/video-js.css'

    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        data() {
            return {
                playerOptions: {
                    width: 640,
                    height: 360,
                    autoplay: false,
                    muted: false,
                    language: 'en',
                    playbackRates: [0.7, 1.0, 1.5, 2.0],
                    sources: []
                }
            }
        },
        computed: {
            player() {
                return this.$refs.videoPlayer.player
            }
        },
        methods: {
            playerReadied(player) {
                console.log('Player loaded', player);
            }
        },
        mounted() {

            if (this.field.value) {
                // add the current field video to the options array
                this.playerOptions.sources = [{
                    // type: "video/mp4",
                    // mp4
                    src: "/storage/videos/" + this.field.value,
                    // webm
                    // src: "https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm"
                }];
            }
        }
    }
</script>
