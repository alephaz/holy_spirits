<template>
    <div class="card card-video mb-5">
        <div class="card-header">
            <div class="country text-uppercase" v-if="this.videoModel.country">
                <div class="country-name">
                    {{ this.videoModel.country }}
                </div>
                <span v-bind:class="this.flagClass"></span>
            </div>
            <div class="location" v-bind:class="{single : !this.videoModel.country_code}">
                {{ this.videoModel.location }}
            </div>
        </div>
        <div class="card-body">

            <div v-if="this.videoModel.type == 'youtube'">
                <div class="card-video-youtube" v-if="this.isMobile">
                    <youtube :video-id="this.videoModel.video_id" :player-vars="this.playerVars"
                             ref="youtube"></youtube>
                </div>

                <div class="card-video" @click="playVideo()" v-if="!this.isMobile">
                    <img v-bind:src="this.videoModel.image_url" v-if="!this.playing" class="img-thumbnail">

                    <div class="card-video-youtube" v-if="this.playing">
                        <youtube :video-id="this.videoModel.video_id" :player-vars="this.playerVars"
                                 ref="youtube"></youtube>
                    </div>

                    <button type="button" ref="playButton" v-if="!this.playing" class="btn btn-play text-red"></button>
                </div>
            </div>

            <div v-if="this.videoModel.type == 'custom'">
                <div class="card-video" @click="customPlayVideo()">
                    <img v-bind:src="this.videoModel.custom_video_image" v-if="!this.customPlaying" class="img-thumbnail">

                    <div class="card-video-custom" v-if="this.customPlaying">
                        <video-player class="vjs-custom-skin"
                                      ref="videoPlayer"
                                      :options="customPlayerOptions"
                                      :playsinline="true"
                                      @ready="playerReadied">
                        </video-player>
                    </div>

                    <button type="button" ref="playButton" v-if="!this.customPlaying" class="btn btn-play text-red"></button>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <h3 class="card-title my-3">{{ this.videoModel.title }}</h3>
            <div v-if="this.videoModel.type == 'custom'" v-html="this.videoModel.description"></div>
            <div class="card-social" v-if="sharing">
                <h6 class="text-blue font-weight-bold mb-2">
                    <span v-if="language == 'en'">Help us to reach more lives with the gospel by sharing this video</span>

                    <span v-if="language == 'es'">Ayúdanos a alcanzar mas vidas con el evangelio compartiendo este video</span>
                </h6>
                <div class="row">
                    <div class="col-md-7 col-lg-8 col-sm-12">
                        <button type="button"
                                @click="shareOnFacebook()"
                                class="btn btn-primary btn-fb btn-width-equal text-left">
                            <i class="fab fa-facebook-f"></i>
                            <span v-if="language == 'en'">
                                Share On Facebook
                            </span>

                            <span v-if="language == 'es'">
                                Compartir en Facebook
                            </span>
                            
                            <span v-if="language == 'iw'">
                                שתף בפייסבוק
                            </span>
                        </button>
                        <button type="button"
                                @click="shareOnTwitter()"
                                class="btn btn-primary btn-tw btn-width-equal text-left">
                            <i class="fab fa-twitter"></i>
                            <span v-if="language == 'en'">
                                Share On Twitter
                            </span>

                            <span v-if="language == 'es'">
                                Compartir en Twitter
                            </span>
                            
                            <span v-if="language == 'iw'">
                                שתף בטוויטר
                            </span>
                        </button>
                    </div>
                    <div class="col-md-5 col-lg-4  text-md-right text-sm-left mobile-mt-2"
                         v-if="this.videoModel.type == 'youtube'">
                        <a href="https://www.youtube.com/channel/UChIdLlwVNwTwF2lswUnIhJg?sub_confirmation=1"
                           target="_blank"
                           class="btn btn-primary btn-yt text-uppercase btn-width-equal">
                            <i class="fab fa-youtube"></i>
                            <span v-if="language == 'en'">
                                Subscribe
                            </span>

                            <span v-if="language == 'es'">
                                SUSCRIBIRSE
                            </span>
                            
                            <span v-if="language == 'iw'">
                                הירשם כמנוי
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueYoutube from 'vue-youtube';
    import VueVideoPlayer from 'vue-video-player'

    import 'video.js/dist/video-js.css'

    Vue.use(VueYoutube);
    Vue.use(VueVideoPlayer);

    export default {
        props: [
            'video',
            'agent',
            'sharing'
        ],
        data() {
            return {
                language: window.HolySpirit.language,
                playing: false,
                customPlaying: false,
                playerVars: {
                    origin: 'http://www.holyspirit.tv',
                    controls: 1,
                    modestbranding: 1,
                    autohide: 1,
                    theme: 'dark',
                    height: 360,
                    resize: false,
                    fitParent: true,
                    rel: 0,
                    showinfo: 0
                },
                customPlayerOptions: {
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
            flagClass() {
                return 'flag flag-' + this.videoModel.country_code.toLocaleLowerCase();
            },
            player() {
                return this.$refs.youtube.player
            },
            videoModel: function () {
                if (this.video) {
                    if (this.video.youtube_link && this.video.youtube_link.length) {
                        var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                        var match = this.video.youtube_link.match(regExp);
                        this.video.video_id = (match && match[7].length == 11) ? match[7] : false;
                        this.video.image_url = (this.video.youtube_image ? this.video.youtube_image : ((match && match[7].length == 11) ? 'https://img.youtube.com/vi/' + match[7] + '/maxresdefault.jpg' : false));
                    }

                    return this.video;
                }

                return false;
            },
            isMobile: function () {
                return this.agent.isPhone || this.agent.isTablet;
            },
            customPlayer() {
                return this.$refs.videoPlayer.player
            }
        },
        methods: {
            playVideo() {
                this.playing = !0;
                let timer = setInterval(function () {
                    if (this.$refs.youtube) {
                        clearInterval(timer);
                        this.$refs.youtube.player.playVideo();
                    }
                }.bind(this), 100);
            },
            shareOnFacebook() {
                var windowReference = window.open(false, '_blank', 'width=626, height=436');
                windowReference.location = 'https://www.facebook.com/sharer/sharer.php?u=' + this.videoModel.youtube_link;
                windowReference.name = 'facebook-share-dialog';
            },
            shareOnTwitter() {
                var windowReference = window.open(false, '_blank', 'width=626, height=436, status=1');
                windowReference.location = 'http://twitter.com/share?url=' + this.videoModel.youtube_link;
                windowReference.name = 'twitter-share-dialog';
            },
            playerReadied(player) {
                console.log('Player loaded', player);

                player.play();
            },
            customPlayVideo(){
                this.customPlaying = !0;
            }
        },
        mounted() {
            if(this.videoModel.type === 'custom'){
                // add the current field video to the options array
                this.customPlayerOptions.sources = [{
                    // type: "video/mp4",
                    // mp4
                    src: "/storage/videos/" + this.videoModel.video_link,
                    // webm
                    // src: "https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm"
                }];
            }

        }
    }
</script>
<style>
    /*.card-video-youtube iframe {*/
    /*height: 410px !important;*/
    /*}*/
</style>