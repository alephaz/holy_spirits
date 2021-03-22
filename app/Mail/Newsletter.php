<?php

namespace App\Mail;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var \App\Models\Newsletter
     */
    private $newsletter;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Newsletter $newsletter
     */
    public function __construct(\App\Models\Newsletter $newsletter)
    {
        // Data model
        $this->newsletter = $newsletter;

        // set subject
        $this->subject = $this->newsletter->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {

        // create output array with data
        $newsletter = $this->newsletter->toArray();


        // check if there are videos in the newsletters
        foreach (['a', 'b', 'c'] as $block_id) {

            // set the video element as false in order to help in the validations
            $video = false;

            // check there is a video for the block
            if ($this->newsletter->{'block_' . $block_id . '_video'}) {

                // get the video for the block
                $youtube_video = (new Video())->find($this->newsletter->{'block_' . $block_id . '_video'});

                // validate the video
                if ($youtube_video) {

                    // check if there is an image in youtube image
                    $image = $youtube_video->youtube_image;

                    // if no image found check if there is a video in the media resource
                    if (!$image && $youtube_video->hasMedia('youtube_image')) {
                        $image = $youtube_video->getFirstMedia('youtube_image')->getUrl();
                    }

                    $video = [
                        'image' => $image,
                        'link' => $youtube_video->youtube_link
                    ];
                }
            }

            // assign the video to the main array
            $newsletter['block_' . $block_id . '_video'] = $video;


            $custom_image = false;

            // check if there is an image and load it
            if($this->newsletter->hasMedia('block_' . $block_id . '_image')){

                $custom_image = [
                    'image' => $this->newsletter->getFirstMedia('block_' . $block_id . '_image')->getFullUrl(),
                    'url' => $newsletter['block_' . $block_id . '_image_link'] ? $newsletter['block_' . $block_id . '_image_link'] : ''
                ];

            }

            // assign the video to the main array
            $newsletter['block_' . $block_id . '_custom_image'] = $custom_image;

        }


        return $this->view('emails.newsletter', [
            'data' => $newsletter
        ]);
    }
}
