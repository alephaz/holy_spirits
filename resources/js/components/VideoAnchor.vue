<template>
    <div>
        <div v-for="video in videoDisplayList">
            <video-block v-bind:video="video" v-bind:agent="agent" v-bind:sharing="sharing"></video-block>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VideoAnchor",
        props: [
            'agent',
            'sharing'
        ],
        data() {
            return {
                videoList: [],
                videoDisplayList: []
            };
        },
        methods: {
            setVideoList(videoList) {
                this.videoList = videoList;
            },
            scroll() {
                window.onscroll = () => {

                    let bottomOfWindow = (($(document).scrollTop()) + window.innerHeight) > (document.documentElement.offsetHeight - 500);

                    if (bottomOfWindow) {

                        let video = this.videoList.shift();
                        if (video) {
                            this.videoDisplayList.push(video);
                        }

                        let videoOne = this.videoList.shift();
                        if (videoOne) {
                            this.videoDisplayList.push(videoOne);
                        }

                        let videoTwo = this.videoList.shift();
                        if (videoTwo) {
                            this.videoDisplayList.push(videoTwo);
                        }
                    }
                };
            }
        },
        mounted() {
            // check if a video list exists
            let i = setInterval(() => {
                if (window.videoList && window.videoList.length) {
                    // bind the video list
                    this.videoList = window.videoList;
                    // stop the timer
                    clearInterval(i);
                    // start scroll watch
                    this.scroll();
                    // take the user to the top of the page
                    document.documentElement.scrollTop = 0;
                }
            }, 100);
        }
    }
</script>

<style scoped>

</style>