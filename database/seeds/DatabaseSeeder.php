<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $admin_role = (new \App\Models\Role())->create([
            'name' => 'Administrator',
            'permissions' => route_get_alias_list()
        ]);
        $partner_role = (new \App\Models\Role())->create([
            'name' => 'Partner',
            'permissions' => route_get_alias_list()
        ]);

        $admin = (new \App\Models\User())->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'remember_token' => str_random(10)
        ]);

        $admin->roles()->attach($admin_role);

        $video_channels = [
            [
                'en' => 'Home',
                'es' => 'Inicio'
            ],
            [
                'en' => 'Nations',
                'es' => 'Naciones'
            ],
            [
                'en' => 'Youth',
                'es' => 'Jovenes'
            ],
            [
                'en' => 'TV Episodes',
                'es' => 'Television'
            ],
            [
                'en' => 'Messages',
                'es' => 'Mensajes'
            ],
            [
                'en' => 'Teachings',
                'es' => 'Enseñanzas'
            ],
            [
                'en' => 'Latest',
                'es' => 'Nuevos'
            ]
        ];

        foreach ($video_channels as $key => $channel) {
            $video_channel = (new \App\Models\VideoChannel())->create([
                'title' => $channel,
                'machine_name' => snake_case($channel['en']),
                'slug' => str_slug($channel['en']),
                'description' => $channel['en'],
                'weight' => $key,
                'display_in_menu' => ($key ? 1 : 0)
            ]);

            if ($channel['en'] === 'Teachings') {
                $video_channel->roles()->attach(2);
            }

        }

        $menu_items = [
            [
                'id' => 1,
                'title' => [
                    'en' => 'Home',
                    'es' => 'Inicio'
                ],
                'description' => [
                    'en' => 'Home',
                    'es' => 'Inicio'
                ],
                'slug' => '/',
                'weight' => 0,
                'menu_id' => null
            ],
            [
                'id' => 2,
                'title' => [
                    'en' => 'Info',
                    'es' => 'Info'
                ],
                'description' => [
                    'en' => 'Info',
                    'es' => 'Info'
                ],
                'slug' => '#',
                'weight' => 1,
                'menu_id' => null
            ],
            [
                'id' => 3,
                'title' => [
                    'en' => 'Events',
                    'es' => 'Eventos'
                ],
                'description' => [
                    'en' => 'Events',
                    'es' => 'Eventos'
                ],
                'slug' => '/events',
                'weight' => 0,
                'menu_id' => 2
            ],
            [
                'id' => 4,
                'title' => [
                    'en' => 'About',
                    'es' => 'Conócenos'
                ],
                'description' => [
                    'en' => 'About',
                    'es' => 'Conócenos'
                ],
                'slug' => '/page/about',
                'weight' => 0,
                'menu_id' => 2
            ],

            [
                'id' => 5,
                'title' => [
                    'en' => 'Vision',
                    'es' => 'Visión'
                ],
                'description' => [
                    'en' => 'Vision',
                    'es' => 'Visión'
                ],
                'slug' => '/page/vision',
                'weight' => 1,
                'menu_id' => 2
            ],

            [
                'id' => 6,
                'title' => [
                    'en' => 'Invitations',
                    'es' => 'Invitaciones'
                ],
                'description' => [
                    'en' => 'Invitations',
                    'es' => 'Invitaciones'
                ],
                'slug' => '/invitations',
                'weight' => 3,
                'menu_id' => null
            ],

            [
                'id' => 7,
                'title' => [
                    'en' => 'MultiMedia',
                    'es' => 'MultiMedia'
                ],
                'description' => [
                    'en' => 'MultiMedia',
                    'es' => 'MultiMedia'
                ],
                'slug' => '#',
                'weight' => 4,
                'menu_id' => null
            ],

            [
                'id' => 8,
                'title' => [
                    'en' => 'New Book',
                    'es' => 'Nuevo Libro'
                ],
                'description' => [
                    'en' => 'New Book',
                    'es' => 'Nuevo Libro'
                ],
                'slug' => '/page/new-book',
                'weight' => 0,
                'menu_id' => 7
            ],

            [
                'id' => 9,
                'title' => [
                    'en' => 'Photos',
                    'es' => 'Fotos'
                ],
                'description' => [
                    'en' => 'Photos',
                    'es' => 'Fotos'
                ],
                'slug' => '/page/photos',
                'weight' => 1,
                'menu_id' => 7
            ],

            [
                'id' => 10,
                'title' => [
                    'en' => 'Audio',
                    'es' => 'Audio'
                ],
                'description' => [
                    'en' => 'Audio',
                    'es' => 'Audio'
                ],
                'slug' => '/page/audio',
                'weight' => 1,
                'menu_id' => 7
            ],

            [
                'id' => 11,
                'title' => [
                    'en' => 'Support Us',
                    'es' => 'Contribuir'
                ],
                'description' => [
                    'en' => 'Support Us',
                    'es' => 'Contribuir'
                ],
                'slug' => '#',
                'weight' => 4,
                'menu_id' => null
            ],

            [
                'id' => 12,
                'title' => [
                    'en' => 'Donations',
                    'es' => 'Donaciones'
                ],
                'description' => [
                    'en' => 'Donations',
                    'es' => 'Donaciones'
                ],
                'slug' => '/page/donations',
                'weight' => 0,
                'menu_id' => 11
            ],

            [
                'id' => 13,
                'title' => [
                    'en' => 'Partnership',
                    'es' => 'Patrocine el Ministerio'
                ],
                'description' => [
                    'en' => 'Partnership',
                    'es' => 'Patrocine el Ministerio'
                ],
                'slug' => '/partnership',
                'weight' => 1,
                'menu_id' => 11
            ],

            [
                'id' => 14,
                'title' => [
                    'en' => 'Contact Us',
                    'es' => 'Contáctenos'
                ],
                'description' => [
                    'en' => 'Contact Us',
                    'es' => 'Contáctenos'
                ],
                'slug' => '/contact-us',
                'weight' => 5,
                'menu_id' => null
            ],

            [
                'id' => 15,
                'title' => [
                    'en' => 'Prayer Request',
                    'es' => 'Petición de Oración'
                ],
                'description' => [
                    'en' => 'Prayer Request',
                    'es' => 'Petición de Oración'
                ],
                'slug' => '/prayer-request',
                'weight' => 0,
                'menu_id' => 14
            ],

            [
                'id' => 16,
                'title' => [
                    'en' => 'Send us your Testimony',
                    'es' => 'Envía tu testimonio'
                ],
                'description' => [
                    'en' => 'Send us your Testimony',
                    'es' => 'Envía tu testimonio'
                ],
                'slug' => '/testimony',
                'weight' => 1,
                'menu_id' => 14
            ],

            [
                'id' => 17,
                'title' => [
                    'en' => 'Comments / Questions',
                    'es' => 'Comentarios / Preguntas'
                ],
                'description' => [
                    'en' => 'Comments / Questions',
                    'es' => 'Comentarios / Preguntas'
                ],
                'slug' => '/comments-questions',
                'weight' => 2,
                'menu_id' => 14
            ],
        ];

        foreach ($menu_items as $item) {
            (new \App\Models\Menu())->create($item);
        }

        $pages = [
            [
                'title' => 'About Us',
                'body' => '<p>Andres, Giannina and their two children, Elijah and Anabella have been called by the Lord to minister the gospel in the power of the Holy Spirit to the nations. They reside in Houston, Texas.<br>
Andres was born in Neuquen, Argentina. &nbsp;He was raised in a Christian home and surrendered his life to Jesus at the age of eight.</p>
<p>He moved to the United States with his family at a young age. &nbsp;He graduated from Baylor University with a degree in Economics and Chemistry, and was accepted to the University of Texas Medical School. Before beginning his training to become a medical doctor, he had a supernatural encounter with the Holy Spirit that changed the course of his life. &nbsp;In a university exchange program where he had returned to his country to study for six months, he found himself in the midst of a revival where he met the Holy Spirit. The Lord revealed his heart to him and called him to preach the gospel, to pray for the sick, and to take the Fire of the Holy Spirit to the nations. &nbsp; He decided to leave medical school dedicating his life to obeying God’s calling.</p>
<p>Giannina was born in Cartagena, Colombia where she surrendered her life to Jesus at the age of fifteen, and soon after that she was called by the Lord to minister to the nations. &nbsp;She moved to the United States after marrying Andres. &nbsp;She is a certified minister under the Assemblies of God, and currently ministers alongside her husband and at women’s conferences around the world.</p>',
                'slug' => 'about'
            ],

            [
                'title' => 'Vision',
                'body' => '<p>Our vision is to reach Houston, the United States and the nations with the gospel of Jesus Christ through miracles crusades, revival services and youth events.</p>',
                'slug' => 'vision'
            ],
            [
                'title' => 'New Book “My Beloved Holy Spirit”',
                'body' => '<p>Experience the wonder of knowing and loving the Spirit of God and discover the secrets to being used by His power.  Receive the book, “My Beloved Holy Spirit,” written by Andres Bisonni as a thank you gift when you partner with the ministry. For more information on how you may support us so that we may continue to take the gospel to the nations, simply click below:</p>
<p><a href="/partnership">PARTNER WITH US</a></p>',
                'slug' => 'new-book'
            ],
            [
                'title' => 'Photo Updates',
                'body' => '<p>As we travel around the world taking the gospel, we would like to share with you behind the scenes photos and videos of what the Holy Spirit is doing in the nations.</p>
<p>To receive these live on location updates, you may like us on Facebook, or follow us on our Instagram account:</p>
<p><a href="http://instagram.com/andresbisonni?ref=badge"><img src="//badges.instagram.com/static/images/ig-badge-view-24.png" alt="Instagram" /></a></p>',
                'slug' => 'photos'
            ],
            [
                'title' => 'Audio',
                'body' => '<p>Andres Bisonni shares a ten part series of messages on how to have a deeper relationship with the Holy Spirit and how to be used by His power to minister to others. &nbsp;Through this series you will discover:</p>
<p>&nbsp;</p>
<p>-How to have a supernatural encounter with the Spirit of God</p>
<p>-How to develop a deeper intimacy with the Holy Spirit</p>
<p>-How to be empowered by the Holy Spirit to heal the sick and bring deliverance to the captives</p>
<p>&nbsp;</p>
<p>This is a life changing series that will give you a deeper understanding of the mysteries of the Spirit of God.</p>
<p>&nbsp;</p>
<p>We are making this series available to those who partner with the ministry to help us continue to go to the nations taking the gospel of Jesus Christ in the power of the Holy Spirit.</p>
<p>&nbsp;</p>
<p>Fore more information please click here: &nbsp; <a title="Become a Partner" href="/partnership">HOW TO BECOME AN ABM PARTNER</a></p>
<p>&nbsp;</p>
<p>&nbsp;</p>',
                'slug' => 'audio'
            ],
            [
                'title' => 'Donations',
                'body' => '<p>Your donations make it possible for us to continue to take the gospel to different nations and for countless of lives to be transformed by the Fire of the Holy Spirit.</p>
<p>You may securely donate online through PayPal by clicking here:</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick"><br>
<input type="hidden" name="hosted_button_id" value="KUS3UGDSC4A98"><br>
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><br>
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"><br>
</form>
<p>or you may send your donations to:</p>
<h4><span style="color: #1166aa;">Andres Bisonni Ministries<br>
P.O. BOX 163<br>
League City, TX 77574</span></h4>
<h4>Thank you for all your love and support!</h4>',
                'slug' => 'donations'
            ],
            [
                'title' => 'Latest',
                'body' => '<p>As we continue to minister around the world, we are constantly producing new video compilations showing the move of the Holy Spirit from different crusades and youth events.</p><p>Through these videos we hope to not only inform you of what the Holy Spirit is doing in different nations, but we also desire to encourage you to a deeper relationship with the Lord.</p>
<p>We also pray for the videos to be empowered by the Holy Spirit to bring healing, motivation and transformation to your life.

You may sign up to freely receive our latest videos by subscribing to our newsletter</p>',
                'slug' => 'latest'
            ],
            [
                'title' => 'Thank you for your Donation!',
                'body' => '<p><img class="size-full wp-image-1209 alignleft" alt="andres-bissoni-family" src="http://abm.cc/live/wp-content/uploads/2013/02/andres-bissoni-family.jpg" width="180" height="231">It encourages us so much to know that there are people who love us and believe in the calling that the Lord has placed upon our lives. Your contributions make it possible for us to continue sharing the gospel, praying for those in need and taking the Fire of the Holy Spirit to the nations. We pray for the Lord to supply all of your needs according to His riches in glory by Christ Jesus!<br>
Thank you for giving to the Holy Spirit!</p>',
                'slug' => 'thank-you'
            ]
        ];

        foreach ($pages as $page) {
            (new \App\Models\Page())->create($page);
        }

        $events = [
            "2018" => [
                "January 11-13:  Kingdom Domain School, Asheville, North Carolina",
                "February 16-17:  Miracle Crusade, Colombo, Sri Lanka",
                "February 18: Youth Revival, Colombo, Sri Lanka",
                "May 11: Miracle Crusade, Chiapas, Mexico",
                "May 12: Youth Event, Chiapas, Mexico",
                "June 1-2: Youth Event, Fortaleza, Brazil",
                "June 3: Miracle Crusade, Fortaleza, Brazil",
                "June 16-26: The Promise TV filming, Israel",
                "July 12-13: Revival and Miracle Services, Kansas City, Kansas",
                "July 18-20: Awakening Conference, Yangon, Myanmar",
                "August 24-25: Holy Spirit Conference, Tri-Cities, Washington",
                "September 7: Prayer Vigil, Maracaná Stadium, Panama City, Panama www.PtyparaCristo.com",
                "September 8: Youth Event, Colon, Panama www.PtyparaCristo.com",
                "September 9: March for Jesus, Cinta Costera, Panama www.PtyparaCristo.com",
                "September 10:  School of Evangelism,Panama City, Panama www.PtyparaCristo.com",
                "September 21-22: Miracle Crusade, General Santos City, Philippines https://facebook.com/gensanwt",
                "September 24:  Revival Service, Manila, Philippines https://facebook.com/pcectfcom",
                "October 10-12: New Life Conference, Auckland, New Zealand https://newlifeconference.nz/",
                "November 1: Miracle and Revival Crusade, Malaga, Spain http://www.nochesdeesperanza.es",
                "November 2: Miracle and Revival Crusade, Jerez de la Frontera, Spain http://www.nochesdeesperanza.es",
                "November 3: Miracle and Revival Crusade, Sevilla, Spain http://www.nochesdeesperanza.es",
                "November 21-22: Youth Event, Denver, Colorado http://www.cddcyouth.com",
                "November 23: Youth Event, Dallas, Texas http://www.southcentralyouth.org",
            ],
            "2017" => [
                "January 14: Miracle Crusade, San Pedro Sula, Honduras",
                "January 15: Revival Service, San Pedro Sula, Honduras",
                "January 28:  Pastors’ Conference, Houston, Texas",
                "February 25-27: Youth Revival, Marilia, Brazil",
                "February 28: Miracle Crusade, Marilia, Brazil",
                "March 28:  Revival Service, Dallas, Texas www.CFNI.org",
                "April 10-12:  Miracle Crusade, San Pedro Sula, Honduras www.Ebenezer.hn",
                "April 19-21:  Revival and Healing Services, Buenos Aires, Argentina www.CatedraldelaFe.org",
                "April 22:  Miracle Crusade, Quilmes, Argentina www.IglesiadelPuente.org",
                "June 22-24:  Pastors and Leaders Conference, Kuala Lumpur, Malaysia",
                "June 25:  Holy Spirit Miracle Crusade, Kuala, Lumpur, Malaysia",
                "July 28:  Pastors and Leaders Conference, Guayaquil, Ecuador",
                "July 29-30: Holy Spirit Miracle Crusade, Guayaquil, Ecuador",
                "August 13:  Holy Spirit Revival Services, Texas City, USA",
                "September 15-17:  Holy Spirit Miracle Crusade,  Panama City, Panama www.SoplaDios.org.pa",
                "October 6-7:  Holy Spirit Revival Service, Houston, USA www.vbcweb.org",
                "November 17-18:  Holy Spirit Miracle Crusade, Cancun, Mexico",
                "November 24:  Holy Spirit Youth Event, Galveston, USA www.tlym.org"],
            "2016" => [
                "January 15:  Revival Service, El Paso, Texas",
                "January 31: Miracle and Healing Crusade, Houston, Texas",
                "February 27: Revival Service, Webster, Texas",
                "March 4-5: Men’s Conference, El Paso, Texas",
                "April 22-23: Youth Event, La Habana, Cuba",
                "April 24: Miracle Crusade, Santiago, Cuba",
                "April 25: Miracle Crusade, Guantanamo, Cuba",
                "April 26: Miracle Crusade, La Habana, Cuba",
                "May 6-8:  Miracle Crusade, Cochin, India",
                "May 20: Youth Event, Rosario Argentina",
                "May 21:  Pentecost Event, Rosario, Argentina",
                "May 22: Miracle Crusade, Rosario, Argentina",
                "June 1-3:  Revival Conference, Yangon, Myanmar",
                "July 16:  Pastors Conference, Nagua, Dominican Republic",
                "July 16:  Youth Event, Nagua, Dominican Republic",
                "July 17:  Miracle Crusade, Nagua, Dominican Republic",
                "August 14-15:  Youth Event, Buenos Aires, Argentina",
                "September 30:  Miracles Crusade, Houston, Texas",
                "October 22-23:  Miracle Crusade, Guayaquil, Ecuador",
                "November 11-12:  Revival Conference, Cartagena, Colombia",
                "November 13:  Miracle Crusade, Cartagena, Colombia",
                "November 19:  Youth Event, Orlando, Florida",
                "November 26-27: Miracle Crusade, Puerto Montt, Chile"],
            "2015" => [
                "January 25:  Revival Service, League City, Texas",
                "February 1:  Revival Service, League City, Texas",
                "February 28:  Youth Revival Event, Stuttgart, Germany",
                "March 1: Miracle Crusade, Stuttgart, Germany",
                "March 26-27:  Miracle Crusade, Freeport, Bahamas",
                "April 10-12:  Miracle Crusade, Buenos Aires, Argentina",
                "April 24-26: Miracle Crusade, Daphne, Alabama",
                "May 23:  Revival Service, Jerusalem, Israel",
                "June 5-6:  Miracle Crusade, Amsterdam, Netherlands",
                "July 3-5:  Miracle Crusade, Aarau, Switzerland",
                "July 23-24: Youth Event, Chihuahua, Mexico",
                "August 7-8:  Youth Event, Columbus, Ohio",
                "September 19: Revival Service, Dickinson, Texas",
                "October 23:  Youth Event, Houston, Texas",
                "October 30:  Miracle Service, Webster, Texas",
                "November 27:  Youth Event, Little Rock, Arkansas"],
            "2014" => [
                "February 28:  Revival Service, Gainesville, Florida",
                "March 1:  Miracle Crusade, Gainesville, Florida",
                "March 14-15:  Youth Event, Puerto Rico",
                "March 16:  Revival Service, Puerto Rico",
                "March 29:  Miracle Crusade, Slovakia",
                "April 18-20:  Miracle Crusade, Buenos Aires, Argentina",
                "April 25-26: Youth Event, Monterrey, Mexico",
                "June 6-8: Holy Spirit Miracle Crusade, Amman, Jordan",
                "June 13: Revival Service, Alexandria, Louisiana",
                "July 14-16:  Miracle Crusade, Austin, Texas",
                "July 26: Youth Event, Managua Nicaragua",
                "August 10: Revival Service, Humble, Texas",
                "August 14-15:  Miracle Crusade, Jakarta, Indonesia",
                "August 16:  Leadership Meeting, Jakarta, Indonesia",
                "August 17:  Miracle Crusade, Surabaya, Indonesia",
                "August 27:  Miracle Service, Woodlands, Texas",
                "August 28: Miracle Service, Houston, Texas",
                "September 12-14: Miracle Crusade, Corrientes, Argentina",
                "October 11-12: Youth Event, Neuquen, Argentina",
                "October 31:  Youth Event, Veracruz, Mexico",
                "November 1: Youth Event, Veracruz, Mexico",
                "November 22: Youth Event, Orlando, Florida",
                "November 28: Youth Event, Houston, Texas"],
            "2013" => [
                "January 11-13: Holy Spirit Miracle Crusade, Drammen, Norway",
                "March 1-3: Holy Spirit Miracle Crusade, Nassau, Bahamas",
                "March 6: Bay Area Christian School, League City, Texas",
                "March 29-31: Holy Spirit Revial Conference, Madrid, Spain",
                "April 26-8: Holy Spirit Miracle Crusade, Austin, Texas",
                "May 8: Holy Spirit Miracle Crusade, Helsinki, Finland",
                "May 9: Holy Spirit Miracle Crusade, Tampere, Finland",
                "May 10: Holy Spirit Miracle Crusade, Helsinki, Finland",
                "May 18-31: The Promise Television Program, Jerusalem, Israel",
                "June 7-9: Holy Spirit Miracle Crusade, Ponce, Puerto Rico",
                "June 15: First Nation Unity Conference, Valdor, Quebec, Canada",
                "July 8-10: Assembly of God Campmeeting, Austin, Texas",
                "July 18-19: Holy Spirit Revival Conference, Guadalajara, Mexico",
                "July 27: Youth Revival Service, Managua, Nicaragua",
                "July 28: Holy Spirit Miracle Crusade, Managua, Nicaragua",
                "August 23-25: Holy Spirit Miracle Crusade, Berlin, Germany",
                "September 22-25: Holy Spirit Miracle Crusade, Belo Horizonte Brazil",
                "October 25-27: Holy Spirit Miracle Crusade, Brussels, Belgium",
                "November 23: Assemblies of God Youth Convention, Daytona Beach, Florida",
                "December 7-9: Holy Spirit Miracle Crusade, Belo Horizonte, Brazil"],
            "2012" => [
                "January 6-8: Holy Spirit Miracle Crusade, Salem, North Carolina",
                "January 15: Holy Spirit Revival Services, Humble, Texas",
                "January 25: Holy Spirit Revival Service, Webster, Texas",
                "January 27: Holy Spirit Healing Service, Las Sierras, Mexico",
                "January 28-29: Holy Spirit Miracle Crusade, Mexico City, Mexico",
                "February 9-11: Holy Spirit Miracle Crusade, Delaware",
                "February 17: Holy Spirit Revival Service, Alvin, Texas",
                "February 23-25: Holy Spirit Miracle Crusade, Barbados",
                "March 3: Holy Spirit Revival Service, Houston, Texas",
                "March 17: Holy Spirit Youth Revival Service, Houston, Texas",
                "March 30-31: Holy Spirit Miracle Crusade, Port Arthur, Texas",
                "April 13-16: Holy Spirit Miracle Crusade, Valence, Hungary",
                "April 21: Holy Spirit Revival Service, Houston, Texas",
                "April 25: Holy Spirit Miracle Service, Woodlands, Texas",
                "April 29: Holy Spirit Miracle Service, Houston, Texas",
                "May 19: Holy Spirit Revival Service, Pasadena, Texas",
                "May 20: Holy Spirit Miracle Service, Pasadena, Texas",
                "May 26-28: Holy Spirit Miracle Crusade, Brussels, Belgium",
                "June 15-16: Holy Spirit Revival Conference, Bedford, England",
                "June 28-30: Holy Spirit Miracle Crusade, Nassau, Bahamas",
                "July 14: Holy Spirit Revival Service, Woodlands, Texas",
                "July 19-21: Louisiana Outpouring, Alexandria, Louisiana",
                "July 26-28: Holy Spirit Miracle Crusade, Lebu, Chile",
                "August 10-12: Holy Spirit Miracle Crusade, Nairobi, Kenya",
                "August 26: Holy Spirit Youth Revival, Mexico City, Mexico",
                "September 7-8: Holy Spirit Miracle Crusade, Raleigh, North Carolina",
                "September 28-29: Assembly of God Men’s Convention, Orlando, Florida",
                "October 1-8: Feast of Tabernacles, Jerusalem, Israel",
                "October 26-28: Holy Spirit Revival Conference, Cartagena, Colombia",
                "November 22: Assembly of God Youth Convention, El Pasto, Texas",
                "November 23: Assembly of God Youth Convention, Dallas, Texas",
                "November 24-25: Holy Spirit Miracle Crusade, Guayaquil, Ecuador"],
            "2011" => [
                "January 8: Dayspring Assembly of God, Humble, Texas",
                "January 8-10: Solid Rock Baptist Church, Humble, Texas",
                "January 20-22: Holy Spirit Miracle Crusade, La Chorrera, Panama",
                "January 23: Holy Spirit Revival Service, Panama City, Panama",
                "January 29: Holy Spirit Miracle Crusade, Las Sierras, Mexico",
                "January 30: Holy Spirit Miracle Service, Mexico City, Mexico",
                "February 6: Holy Spirit Miracle Service, Alvin, Texas",
                "February 11-13: Holy Spirit Miracle Crusade, San Antonio, Texas",
                "February 22: Celebracion en Daystar! Television Program",
                "February 26: Holy Spirit Youth Event, Houston, Texas",
                "March 4: United Nations, Richmond Hill, New York",
                "March 4-5: Holy Spirit Youth Revival, Elizabeth, New Jersey",
                "March 5: Holy Spirit Miracle Service, Elizabeth, New Jersey",
                "March 16: Holy Spirit Miracle Serevice, Amsterdam, Holland",
                "March 17-20: Holy Spirit Miracle Crusade, Brussels, Belgium",
                "March 26: Holy Spirit Revival Service, Houston, Texas",
                "March 27: Holy Spirit Miracle Service, Kemah, Texas",
                "April 3: Holy Spirit Miracle Service, Pasadena, Texas",
                "April 15-17: Assembly of God Men’s Conference, Tampa, Florida",
                "April 21-23: Fresh Wind Youth Conference, Toronto, Canada",
                "May 12-16: Holy Spirit Miracle Crusade, Tasmania, Australia",
                "June 10-12: Holy Spirit Revival Service, Aarau, Switzerland",
                "June 24-26: Holy Spirit Miracle Crusade, Clute, Texas",
                "July 8-10: Holy Spirit Miracle Crusade, Raleigh, North Carolina",
                "July 24: Pasion mas Fuego, Youth Event, Houston, Texas",
                "August 11-13: Holy Spirit Miracle Crusade, Guadalajara, Mexico",
                "August 26-27: Holy Spirit Youth Revival, Providence, Rhode Island",
                "October 1: Prison Ministry, Wynne Unit, Huntsville, Texas",
                "October 6: Holy Spirit Revial Conference, Houston, Texas",
                "October 9: Holy Spirit Miracle Crusade, Kampala, Uganda",
                "October 12-15: Holy Spirit Miracles Crusade, South Africa",
                "November 10-13: Holy Spirit Miracle Crusade, Singapore",
                "November 25: Youth Holy Spirit Event, Oklahoma City, Oklahoma"],
            "2010" => [
                "January 3: Dayspring Assembly of God, Humble, Texas",
                "January 24-26: Holy Spirit Miracle Crusade, Austin, Texas",
                "January 27: Holy Spirit and Fire Youth event, Austin, Texas",
                "January 30-31: Holy Spirit Miracle Crusade, Mexico City, Mexico",
                "February 21: Turning Point, League City, Texas",
                "February 26: Holy Spirit and Fire Youth Event, Chicago, Illinois",
                "February 27-28: Holy Spirit Miracle Crusade, Chicago Illinois",
                "March 7: Iglesia Cristiana Getsemani, Houston, Texas",
                "March 19: Holy Spirit and Fire Youth Event, Bogota, Colombia",
                "March 19: Holy Spirit Miracle Crusade, Bogota, Colombia",
                "March 21: Iglesia Cristiana Manantial de Vida, Bogota, Colombia",
                "March 27-28: Holy Spirit Miracle Crusade, Cartagena, Colombia",
                "April 23: Holy Spirit and Fire Youth Event, Brownsville, Texas",
                "April 24: Holy Spirit and Fire Youth Event, Mission, Texas",
                "April 25: Centro Familiar Cristiano, Mission, Texas",
                "April 26: Holy Spirit Miracle Crusade, Weslaco, Texas",
                "April 27: Celebracion, Daystar Television Network",
                "April 30: Holy Spirit Miracle Crusade, Raleigh, North Carolina",
                "May 1: Holy Spirit Miracle Crusade, Raleigh, North Carolina",
                "May 9: Holy Spirit Revival Service, Houston, Texas",
                "May 21-23: Holy Spirit Miracle Crusade, Guernsey Island, UK",
                "May 28-30: Holy Spirit Miracle Crusade, Humacau, Puerto rico",
                "June 4-6: Holy Spirit Miracle Crusade, Ponce, Puerto Rico",
                "June 11-12: Holy Spirit and Fire Youth Event, San Pedro Sula, Honduras",
                "June 13: Holy Spirit Miracle Crusade, San Pedro Sula, Honduras",
                "July 16-17: Holy Spirit Youth Event, Boston, Massachusetts",
                "July 18: Holy Spirit Miracle Crusade, Boston, Massachusetts",
                "July 20: Celebration! Daystar, Dallas, Texas",
                "August 11: Holy Spirit Revival Service, Houston, Texas",
                "August 19-22: Holy Spirit Miracle Crusade, New York, New York",
                "September 3-4: Holy Spirit Miracle Crusade, Galilee, Israel",
                "September 5: Holy Spirit Miracle Crusade, Jerusalem, Israel",
                "September 6: Holy Spirit Miracle Crusade, Bethlehem, Israel",
                "September 22-26: Signs and Wonders Conference, Toronto, Canada",
                "October 10: Holy Spirit Miracle Service, Clute, Texas",
                "October 22-24: Holy Spirit Miracle Services, Pasadena, Texas",
                "November 12-13: Holy Spirit and Fire Youth Event, Hermosillo, Mexico",
                "November 14: Holy Spirit Miracle Crusade, Hermosillo, Mexico",
                "December 4-5: Holy Spirit Miracle Crusade, Auburn, Alabama"],
            "2009" => [
                "January 4-5: Dayspring Assembly of God, Humble, Texas",
                "January 10-11: Christian Tabernacle, www.ctab.org, Houston, Texas",
                "January 23-25: Holy Spirit Miracle Crusade, San Antonio, Texas",
                "January 30-31: Holy Spirit Miracle Crusade, Augusta, Georgia",
                "February 6-8: Holy Spirit Miracle Crusade, Komaki, Japan",
                "February 10-11: Holy Spirit Miracle Crusade, Nagoya, Japan",
                "February 21-23: Holy Spirit Miracle Crusade, Orlando, Florida",
                "February 25: Holy Spirit Miracle Crusade, www.grace.tv, North Houston, Texas",
                "February 26: Holy Spirit Miracle Crusade, www.grace.tv, South Houston, Texas",
                "February 27: Holy Spirit and Fire Youth Event, Pasadena, Texas",
                "March 6-8: Holy Spirit Miracle Crusade, Waco, Texas",
                "March 19-21: Holy Spirit Miracle Crusade, Raleigh, North Carolina",
                "March 28-29: Holy Spirit Miracle Crusade, Mexico City, Mexico",
                "April 3-5: Holy Spirit Miracle Crusade, Hobbs, New Mexico",
                "April 10-12: Holy Spirit Miracle Crusade, Carpentersville, Illinois",
                "April 11: Youth Revival, Carpentersville, Illinois",
                "April 19: Holy Spirit Miracle Crusade, www.ctab.org, Houston, Texas",
                "April 24-25: Holy Spirit Miracle Crusade, Monterrey, Mexico",
                "April 26: Iglesia Castillo del Rey, Monterrey, Mexico",
                "May 15-17: Holy Spirit Miracle Crusade, Seoul, Korea",
                "May 24: Holy Spirit Miracle Crusade, San Antonio, Texas",
                "May 29-31: Holy Spirit Miracle Crusade, www.tacf.org, Toronto, Canada",
                "June 5-7: Holy Spirit Miracle Crusade, www.icfamilia.com, Ponce, Puerto Rico",
                "June 19-21: Holy Spirit Miracle Crusade, Oceanside, California",
                "June 26: United Pentecostal Youth Camp, Kennedy, Texas",
                "July 12: Holy Spirit Revival Service, Paris, France",
                "July 14-19: Holy Spirit Miracle Crusade, Bujumbura, Burundi",
                "July 25: United Pentecostal National Convention, Corpus Christy, Texas",
                "August 7-8: Holy Spirit Revival Services, Pasadena, Texas",
                "August 15-16: Holy Spirit Miracle Crusade, Houston, Texas",
                "September 9-10: Holy Spirit Miracle Crusade, Lahore, Pakistan",
                "September 25-27: Holy Spirit Miracle Crusade, Castlegar, Canada",
                "September 30: Holy Spirit Miracle Crusade, www.grace.tv, North Houston",
                "October 1: Holy Spirit Miracle Crusade, www.grace.tv,South Houston",
                "October 13: Holy Spirit Miracle Crusade, Bethlehem, Israel",
                "October 14: Holy Spirit Miracle Crusade, Jerusalem, Israel",
                "October 15: Holy Spirit Miracle Crusade, Kufor Yaseef, Israel",
                "October 16: Holy Spirit Miracle Crusade, Ramleh, Israel",
                "October 17: Holy Spirit Miracle Crusade, Shefa Amir, Israel",
                "October 18: Holy Spirit Miracle Crusade, Nazareth, Israel",
                "October 18: Holy Spirit Miracle Crusade, Haifa, Israel",
                "October 31: Holy Spirit Revival Service, Fairfax, Virginia",
                "November 1: Holy Spirit Miracle Service, Fairfax, Virginia",
                "November 21-22: Holy Spirit Youth Revival, West Palm Beach, Florida",
                "December 11-12: Holy Spirit Miracle Crusade, Houston, Texas"],
            "2008" => [


                "January 6: Dayspring Assembly of God, Humble, Texas",
                "January 11-13: Revival Conference, Atlanta, Georgia",
                "January 20: Turning Point Church, League City, Texas",
                "January 25: Youth Event, Budapest, Hungary",
                "January 26: Revival Service, Budapest, Hungary",
                "January 27: Holy Spirit Miracle Crusade, Budapest, Hungary",
                "February 1: Glad Tidings Assembly of God, www.gladtidings.org, Austin, Texas",
                "February 8-10: Holy Spirit Miracle Crusade, Castlegar, British Columbia, Canada",
                "February 23: Miracle Service, Christian Tabernacle, www.ctab.org, Houston, Texas",
                "February 24: Spanish Service, CTAB, Houston, Texas",
                "February 29: Glad Tidings Assembly of God, www.gladtidings.org Austin, Texas",
                "March 1: Glad Tidings Assembly of God, www.gladtidings.org Austin, Texas",
                "March 2: Spanish Service, www.gladtidings.org, Austin, Texas",
                "March 2: Revival Service, Glad Tidings Assembly of God, Austin, Texas",
                "March 8: Youth Conference “Conviction” Catedral de la Familia, Houston, Texas",
                "March 9: Miracle Service, Catedral de la Familia, Houston, Texas",
                "March 20: General Convention, Obregon, Mexico",
                "March 21: Matrimonios Jovenes Convention, Obregon, Mexico",
                "March 22-23: Adolecentes Convention, Obregon, Mexico",
                "March 22-23: Jovenes Convention, Obregon, Mexico",
                "March 28-30: Holy Spirit Miracle Crusade, Ciudad Ojeda, Venezuela",
                "April 4-6: Miracle and Revival Services, Kansas City, Kansas",
                "April 11-13: Miracle and Revival Services, North Carolina",
                "April 25-27: Miracle and Revival Service, Cree Nation, Canada",
                "May 3: Holy Spirit Miracle Crusade, Tokyo, Japan",
                "May 4: Holy Spirit Miracle Crusade, Kanagawa, Japan",
                "May 5: Holy Spirit Miracle Crusade, Hiroshima, Japan",
                "May 6: Holy Spirit Miracle Crusade, Hiroshima, Japan",
                "May 8: Holy Spirit Miracle Service, Seto, Japan",
                "May 9: Holy Spirit Miracle Crusade, Komaki, Japan",
                "May 10-11: Miracle and Revival Services, Macau, China",
                "May 16-17: Holy Spirit Miracle Crusade (Spanish), Austin, TX",
                "May 23-28: Holy Spirit Miracle Crusades, Camaguey, Cuba",
                "May 30-31: Youth Event, Emmanuel Christian Center, Alvin, TX",
                "June 6-8: Revival Services, Comox Valley, Canada",
                "June 20-22: Youth Event, La Promesa Presbyterian Church, New York",
                "June 27-29: Holy Spirit Miracle Crusade, Los Mochis, Mexico",
                "July 4-6: Holy Spirit Revival Services, Grand Junction, Colorado",
                "July 11: Juventud con Fuego, Houston, Texas",
                "July 31: Comunidad de Gracia, Houston, Texas",
                "August 1-3: Holy Spirit Miracle Crusade, Salem, Oregon",
                "August 7: Holy Spirit Miracle Crusade, Popayan, Colombia",
                "August 8-10: Youth Revival, Popayan, Colombia",
                "August 22: Ramla Assemblies of God Church, Ramla, Israel",
                "August 23: Holy Spirit Revival Meeting in Haifa, Israel",
                "August 24: Holy Spirit Revival Meeting in King Of Kings, Jerusalem, Israel",
                "August 25: Holy Spirit Revival Meeting at Christ Church Center, Jerusalem, Israel",
                "August 29-31: Liberty Conference, Mˆnchengladbach, Germany",
                "September 6: Iglesia Renovada de Sion, Houston, TX",
                "September 10: “Launching into the Miraculous” Conference, www.ctab.org, Houston, TX",
                "September 13-14: Tabernaculo de la Fe www.sopladios.com, Panama City, Panama",
                "September 20-21: Bilingual Miracle Crusade, www.ctab.org, Houston, TX",
                "September 27: Congreso Invasion de su Gloria, www.grace.tv, Houston, TX",
                "October 3-5: Youth Revival Conference, Porterville, California",
                "October 10-12: Holy Spirit Miracle Crusade, New Jersey",
                "October 17-18: Youth Revival Conference, San Bernardino, California",
                "October 24-26: Holy Spirit Miracle Crusade, www.gladtidings.org, Austin, TX",
                "October 31: Holy Spirit Miracle Crusade, Valence, Hungary",
                "November 1-2: Holy Spirit Miracle Crusade, Valence, Hungary",
                "November 7-9: Holy Spirit Miracle Crusade, www.elblag.kz.pl, Elblag, Poland",
                "November 13-14: Holy Spirit Miracle Crusades, Lisboa, Portugal",
                "November 15-16: Holy Spirit Miracle Crusades, Porto, Portugal",
                "November 21-23: Holy Spirit Miracle Crusades, Cambridge, England",
                "November 28-30: Holy Spirit Miracle Crusades, Lanzarote, Spain",
                "December 6-7: Holy Spirit Miracle Crusade, Madrid, Spain",
                "December 12-14: Special Event, International Church, Madrid, Spain",
                "December 18-19: Holy Spirit Miracle Crusade, Bari, Italy",
                "December 20-21: Holy Spirit Miracle Crusade, Rome, Italy"],
            "2007" => [
                "January 13: Daystar Television Program",
                "January 14: Dayspiring Church of the Assemblies of God, Humble, TX",
                "January 19: Vigilia Comunidad de Gracia, Houston, TX",
                "January 27: His Touch Assembly of God Youth Service, Texas City, TX",
                "January 28: His Touch Assembly of God, Texas City, TX",
                "February 9-11: First Assembly of God, Pearsall, TX",
                "February 15-18: Revival Conference, Navojoa, Mexico",
                "February 23: Glad Tidings Assembly of God, Austin, TX",
                "March 2: Centro Cristiano Vida, Houston, TX",
                "March 2: Alianza Juvenil Interdenominacional Crisitiana, Katy, TX",
                "March 3-4: Centro Cristiano Vida, Houston, TX",
                "March 10-11: La Vina, Clear Lake, TX",
                "March 16: Youth Service Trigo Limpio, Houston, TX",
                "March 18: Iglesia Cristiana Trigo Limpio, Houston, TX",
                "March 23: Glad Tidings Assembly of God, Austin, TX",
                "March 31: Word of Faith Christian Center, League City, TX",
                "April 1: Dayspring Assembly of God, Humble, TX",
                "April 4,5,6: Iglesia Pentecostes Getsemani, Houston, TX",
                "April 7-8: Lindale Assembly of God, Houston, TX",
                "April 13: Southwestern Assembly of God University, Waxahachie, TX",
                "April 22: Comunidad Misionera de Adoracion, Penbroke Pines, Florida",
                "April 27: Glad Tidings Assembly of God, Austin, TX",
                "May 11-13: El Lugar de su Presencia, Plano, TX",
                "May 25: Glad Tidings Assembly of God, Austin, TX",
                "June 13: Turning Point, League City, TX",
                "June 22: Glad Tidings Assembly of God, Austin, TX",
                "June 24: Faith Assembly of God, San Antonio, TX",
                "June 29: Grace Community Church, Houston, TX",
                "July 1: Iglesia Bautista El Buen Pastor, Pasadena, TX",
                "July 6-7: Universidad Americana, Heredia, Costa Rica",
                "July 8: Centro Cristiano Sarchi, Sarchi, Costa Rica",
                "July 8: Ciudad de Dios, San Jose, Costa Rica",
                "July 10: T.V. program ENLACE",
                "July 11: Catedral de Adoracion, Heredia, Costa Rica",
                "July 12-14: Congreso Impacto Juvenil, Heredia, Costa Rica",
                "July 14: Centro Cristiano Santa Rosa, Costa Rica",
                "July 15: Centro Cristiano de Heredia, Heredia, Costa Rica",
                "July 15: Iglesia Rey de Reyes, Costa Rica",
                "July 18: Youth United for Christ, Palacios, Texas",
                "July 20: Pastors and Leaders Meeting, Nicholasville, Kentucky",
                "July 21-22: Nicholasville United Methodist Church, Nicholasville, Kentucky",
                "July 22: Fuente de Avivamiento, Lexington, Kentucky",
                "July 26: Comunidad de Gracia, Houston, TX",
                "July 27: Glad Tidings Assembly of God, Austin, TX",
                "July 29: Faith Assembly of God, San Antonio, TX",
                "August 3-4: Congreso de Jovenes, Hermosillo, Mexico",
                "August 5: Miracle Crusade, Hermosillo, Mexico",
                "August 6: Pastors Meeting, Hermosillo, Mexico",
                "August 10: The Vineyard Christian Fellowship of Spring, Spring, TX",
                "August 16-18: Congreso de Avivamiento, Tultitlan, Mexico",
                "August 24: Glad Tidings Assembly of God, Austin, TX",
                "August 26: Emmanuel Centro de Adoracion, Alvin, TX",
                "August 31: Grace Community Church, Houston, TX",
                "September 1: United Pentecostal Churches LII Regional Youth Event, Houston, TX",
                "September 2: Juventud con Fuego Leadership meeting, Houston, TX",
                "September 5: Casa de Oracion y Adoracion, Savana Grande, Puerto Rico",
                "September 6: Iglesia de la Familia, Ponce, Puerto Rico",
                "September 7: Iglesia Esmirna, Savana Grande, Puerto Rico",
                "September 8: Youth Event, Iglesia de Dios Pentecostal, Puerto Rico",
                "September 8: Parque Atletico de Savana Eneas, Cruzada de Milagros, Puerto Rico",
                "September 9: Iglesia El Calvario Asambleas de Dios, Hormigueros, Puerto Rico",
                "September 9: Iglesia de Dios Pentecostal, Lajas, Puerto Rico",
                "September 12: Cangrejales, Honduras",
                "September 13: La Paz, Honduras",
                "September 14: Holy Spirit Miracle Crusade, La Lima, Honduras",
                "September 15-16: Holy Spirit Miracle Crusade, Choloma, Honduras",
                "September 17: Colonia el 22 de Junio, La Lima, Honduras",
                "September 21-22: Holy Spirit Miracle Crusade, Ambato, Ecuador",
                "September 22: Youth Event, Ambato, Ecuador",
                "September 23: Iglesia el Buen Oleo, Ambato, Ecuador",
                "September 23: Pastors meeting, Ambato, Ecuador",
                "September 28: Glad Tidings Assembly of God, Austin, TX",
                "September 29: Youth Event, Houston, TX",
                "October 5-7: Comox Valley, Canada",
                "October 12-15: Ministerio a la Familia Asamblea de Dios, New York",
                "October 20-22: Fuente de Avivamiento, Lexington, Kentucky",
                "October 25-26: Youth Event, Edinburg, Texas",
                "October 28: El Lugar de Su Presencia, Dallas, Texas",
                "November 10: Ministracion para lideres – Projeto Vida Nova Petropolis, Brazil",
                "November 10: Projeto Vida Nova Petropolis – Ciudad de Petropolis, Brazil",
                "November 11: Assamblea de Deus Renovada Botafogo (Manha) – – Ciudad Nova Iguazu, Brazil",
                "November 11: Projeto Restaurando Vidas – Ciudad de Nilopolis, Brazil",
                "November 12: Projeto Restaurando Vidas – Ciudad de Nilopolis, Brazil",
                "November 13: Comunidade Evangelica Shema – Ciudad de SJ de Meriti, Brazil",
                "November 14: Comunidade Evangelica Rhema – Ciudad de Sao GonÁalo, Brazil",
                "November 15: Ministerio Apascentar de Queimados – Ciudad de Queimados, Brazil",
                "November 16: Iglesia metodista Wesleyana do Alto da Serra – Ciudad de Petropolis, Brazil",
                "November 17: Cruzada de Milagros – Xerem – Duque de Caxias, Brazil",
                "November 18: Comunidade Evangelica Vitoria – Ciudad de Petropolis, Brazil",
                "November 19: Iglesia Asamblea de Dios, Rio de Janeiro, Brazil",
                "November 21-22: Central Latin American A.G. Youth Convention, Denver, Colorado",
                "November 24-25: Tierra Prometida, Mexico City, Mexico",
                "November 26: Las Sierras, Mexico",
                "November 29-30: Auburn, Alabama",
                "December 1-2: Miracle Service, Raleigh, North Carolina",
                "December 2: Fuente de Salvacion, Knightdale, North Carolina",
                "December 3: Daystar Television Program",
                "December 20-22: Culiacan, Sinaloa, Mexico"],
            "2006" => [
                "January 7, 8: Southwest Church of God, Stafford, TX",
                "January 24: Miracle Crusade Weslaco, TX",
                "January 25: 5:00 PM Radio Vida 7:00 PM Victoria en Cristo",
                "January 26: Miracle Crusade Weslaco, TX",
                "January 27: Torre de Poder, San Juan, TX",
                "January 28: “Healing and Restoration Service” Templo Emmanuel, San Juan, TX",
                "January 29: Miracle Crusade Victoria en Cristo, Tx",
                "February 10-12: Miracle Crusades, Waco, TX",
                "February 17-19: Miracle Crusades, Agua Prieta, Mexico",
                "February 25: Youth Event Christian Tabernacle, Houston, TX",
                "March 3: Jesucristo es la Respuesta, Houston, TX",
                "March 4: Iglesia Bautista El Buen Pastor, Pasadena, TX",
                "March 5: Centro Cristiano Betesda, Pasadena, TX",
                "March 9: Holy Spirit Revial Service, Vigo, Spain",
                "March 10: Holy Spirit Revival Service, Santiago de Compostela, Spain",
                "March 11: Holy Spirit Miracle Service, Ponte Vedra, Spain",
                "March 12: Holy Spirit Revival Service, Lugo, Spain",
                "March 15-16: Holy Spirit Miracle Crusade, Szekesehervan, Hungary",
                "March 19: Holy Spirit Miracle Crusade, Debrecen, Hungary",
                "March 21-22: Miracle Crusades Rumania",
                "March 24-25: Holy Spirit Miracle Crusade Miskolc, Hungary",
                "April 2: A.M. Faith Assembly of God, Pasadena, TX",
                "April 2: P.M. Miracle Service Faith Assembly of God, Pasadena, TX",
                "April 8-9: First Assmbly of God, Rosemberg, TX",
                "April 13-14: Youth Church of God Convention, Hermosillo, Mexico",
                "April 15-16: “Centenial Azusa Street Celebration” Church of God Convention, Hermosillo, Mexico",
                "April 30: Glad Tidings Assembly of God, Austin, TX",
                "May 1-3: Glad Tidings Assembly of God, Austin, TX",
                "May 12-14: Holy Spirit Miracle Crusade, Mexico D. F.",
                "May 25: Youth Event Iglesia Amor y Restauracion, Houston, TX",
                "May 26: Miracle Service, Iglesia Amor y Restauracion, Houston, TX",
                "June 4: Rios de Agua Viva, Cleveland, TX",
                "June 11: Christ’s Church, Clear Lake, TX",
                "July 14-16: Ft. Worth, TX",
                "July 21-22: Youth Conference “Desperate for His Presence” Mission, TX",
                "July 23: Iglesia del Pueblo, Mission, TX",
                "July 24: Miracle Crusade, Mission, TX",
                "July 30: Rios de Agua Viva, West Palm Beach, Florida",
                "July 30: Iglesia Cristo Mi Redentor, West Palm Beach, Florida",
                "August 2,3: Ft. Lauderdale, Florida",
                "Agust 5: Youth Crusade, Cartagena, Colombia",
                "August 6: Anniversary Iglesia La Uncion, Cartagena, Colombia",
                "August 11: Miracle Service, Centro Biblico Internacional, Cartagena, Colombia",
                "August 12: Youth Service, Centro Biblico Internacional, Cartagena, Colombia",
                "August 13: Iglesia Asambleas de Dios CBI, Cartagena, Colombia",
                "August 14: Centro Biblico Internacional, Barranquilla, Colombia",
                "August 16: Centro Familiar Cristiano, Cartagena, Colombia",
                "August 18: Miracle Service Iglesia Nueva Jerusalen, Cartagena, Colombia",
                "August 19: Ayuno La Catellana, Cartagena, Colombia",
                "August 20: Iglesia Nueva Jerusalen, Cartagena, Colombia",
                "September 2-3: San Antonio, TX",
                "September 12: “Faith Store” Conference, Longview, TX",
                "September 14: Universidad Interamericana, San German, Puerto Rico",
                "September 14: Iglesia de Dios Pentecostal, Lajas, Puerto Rico",
                "September 15: Iglesia Pavellon de la Victoria, Hormigueros, Puerto Rico",
                "September 16: Iglesia Roca de la Salvacion Eterna, Sabana Eneas, Puerto Rico",
                "September 17: Casa de Oracion y Adoracion, Sabana Grande, Puerto Rico",
                "September 17: Iglesia de Dios Pentecostal, Lajas, Puerto Rico",
                "September 23-24: Comunidad Vida Familiar, Katy, TX",
                "September 30: First Assembly of God, Rosenberg, TX",
                "October 1: First Assembly of God, Rosenberg, TX",
                "October 22-25: Glad Tidings Assembly of God, Austin, TX",
                "October 28-29: “Conferencia de Avivamiento” Asambleas de Dios, Sonora, Mexico",
                "November 1-5: Valence, Hungary",
                "November 7-8: Munhacs, Ukraine",
                "November 9: Ukraine",
                "November 11-12: Szekelyudvarhely, Romania",
                "November 14-15: Kantorjanos, Hungary",
                "November 17-19: Debrecen, Hungary",
                "November 21-22: Nagyvarad, Rumania",
                "November 26: Paris, France",
                "December 16: Youth Event, Houston, TX",
                "December 17: Iglesia de Dios Restauracion, Columbus, TX"
            ]
        ];

        foreach ($events as $year => $event) {


            foreach ($event as $item) {

                [$date, $event_title] = explode(':', $item);


                // check if the event has 2 or more days
                if (count(explode('-', $date)) > 1) {

                    // get the month and date by spliting the string by an empty space
                    [$month, $numbers] = explode(' ', $date);

                    // get the dates
                    $dates = array_map(function ($e) use ($year, $month) {
                        return date('Y-m-d', strtotime($month . ' ' . $e . ' ' . $year));
                    }, explode('-', $numbers));

                } else {

                    $dates = [date('Y-m-d', strtotime($date . ' ' . $year))];
                }

                (new \App\Models\Event())->create([
                    'title' => $event_title,
                    'slug' => str_slug($event_title),
                    'description' => $event_title,
                    'event_date' => \Carbon\Carbon::createFromFormat('Y-m-d', $dates[0]),
                    'dates' => implode(', ', $dates)
                ]);
            }
        }


        /////////// --- Videos

//        $videos = [
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Experiencing Heaven on Earth", "description" => "Conference", "video_link" => "MobileLOW1crop.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Transformed by His Glory", "description" => "Conference", "video_link" => "AlabamaLOW2Crop.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Pursuing the Knowledge of the Lord", "description" => "Youth Event", "video_link" => "PursuitKnowledgeFullSermon.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Prepare the Way of the Lord", "description" => "Youth Event", "video_link" => "Session F (Freshwind 2011) Andres Bisonni, Cory Asbury.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "A New Creation", "description" => "Youth Event", "video_link" => "Session C (Freshwind 2011) Andres Bisonni, Freshwind Band.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Seven Dimensions of the Presence of the Holy Spirit", "description" => "", "video_link" => "Session F (Signs & Wonders 2010) Andres Bisonni.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Supernatural Signs of the Gospel", "description" => "", "video_link" => "Session D (Signs & Wonders 2010) Andres Bisonni.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "Double Portion of the Anointing", "description" => "Conference", "video_link" => "DoublePortion.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "1 An Encounter with the Holy Spirit", "description" => "Audio", "video_link" => "1 Encounter with the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "2 The Personality of the Holy Spirit", "description" => "Audio", "video_link" => "2 The Personality of the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "3 The Inner Life with the Holy Spirit", "description" => "Audio", "video_link" => "3 The Inner Life with the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "4 Sanctification and the Holy Spirit", "description" => "Audio", "video_link" => "4 Sanctification and the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "5 The Language of the Holy Spirit", "description" => "Audio", "video_link" => "5 The Language of the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "6 The Power of the Holy Spirit", "description" => "Audio", "video_link" => "6 The Power of the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "7 Salvation and the Holy Spirit", "description" => "Audio", "video_link" => "7 Salvation and the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "8 Healing of the Heart and the Holy Spirit", "description" => "Audio", "video_link" => "8 Healing of the Heart and the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "9 Deliverance and the Holy Spirit", "description" => "Audio", "video_link" => "9 Deliverance and the Holy Spirit.mp4.mp4"],
//            ['country' => null, 'location' => null, "type" => "custom", "title" => "10 Miracles and the Holy Spirit", "description" => "Audio", "video_link" => "10 Miracles and the Holy Spirit.mp4.mp4"]
//        ];
//
//        foreach ($videos as $video) {
//
//            $video['slug'] = str_slug($video['title']);
//
//            $video_model = (new \App\Models\Video())->create($video);
//
//            $video_model->channels()->attach(6);
//
//        }

        $videos = [
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=NcQ11ykRtaE', 'country' => 'Brazil', 'location' => 'Fortaleza'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=g7wavj_S17U', 'country' => 'Israel', 'location' => 'Jordan River'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=8zv44JvuTqk', 'country' => 'Mexico', 'location' => 'Chiapas'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=RKgl07Nu-8w', 'country' => 'Argentina', 'location' => 'Quilmes'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=bu5HYVfOPRI', 'country' => 'Sri Lanka', 'location' => 'Colombo'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=EvG8i5HNGjQ', 'country' => 'Brazil', 'location' => 'Marilia'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=rDhgoCQQc-U', 'country' => 'India', 'location' => 'Kottarakkara'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=o36uIzUTYEI', 'country' => 'Honduras', 'location' => 'San Pedro Sula'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=koD-NUZ5dQw', 'country' => null, 'location' => null],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=h9Zx2ZZF4rY', 'country' => 'United States', 'location' => 'Orlando'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=qAaH6KLgJBs', 'country' => 'Germany', 'location' => 'Stuttgart'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Ppk1uoy-OdA', 'country' => 'Argentina', 'location' => 'Buenos Aires'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=xbShTTc0TjI', 'country' => 'Slovakia', 'location' => 'Banska Bystrica'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=EXsJK9hcEHo', 'country' => 'Indonesia', 'location' => 'Jakarta'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=kCXQA1dVe1k', 'country' => 'Kenya', 'location' => 'Nairobi'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=O9uDM8jwXi8', 'country' => 'United States', 'location' => 'Huntsville'],
            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=20OoguQVet4', 'country' => 'Pakistan', 'location' => 'Lahore']
        ];

        foreach ($videos as $video) {

            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video['youtube_link'], $output_array);

            if (isset($output_array[7])) {

                $content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $output_array[7]);
                parse_str($content, $ytarr);

                $video['title'] = $ytarr['title'];
                $video['slug'] = str_slug($ytarr['title']);
                $video['youtube_image'] = 'https://img.youtube.com/vi/' . $output_array[7] . '/maxresdefault.jpg';
            }


            $video['country'] = collect(config('countries'))->search($video['country'], true);

            $video_model = (new \App\Models\Video())->create($video);

            $video_model->channels()->attach(1);

            try {
                $content = file_get_contents($video['youtube_image']);

                if ($content) {
                    $video_model->addMediaFromUrl($video['youtube_image'])->toMediaCollection('youtube_image');
                }
            } catch (Exception $exception) {

            }
        }
//
//        $videos = [
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=-MAkhbmY3qA', 'country' => 'MY', 'location' => 'Klang'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=SkH1bjCD-cE', 'country' => 'US', 'location' => 'Asheville'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=YVcTCooxEFY', 'country' => 'AR', 'location' => 'Buenos Aires'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=AuhSruwlGms', 'country' => 'PA', 'location' => 'Panama City'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=SLiE53RkcPw', 'country' => 'US', 'location' => 'Dallas'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=nRI9wDYGXEQ', 'country' => 'EC', 'location' => 'Guayaquil'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=o36uIzUTYEI', 'country' => 'HN', 'location' => 'San Pedro Sula'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=VjgWmmy7v7Y', 'country' => 'CO', 'location' => 'Cartagena'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=YyTLtoQt8LU', 'country' => 'AR', 'location' => 'Rosario'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=rDhgoCQQc-U', 'country' => 'IN', 'location' => 'Kottarakkara'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=f3oQeX5yerw', 'country' => 'MM', 'location' => 'Yangon'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Vfu1Q-8qNys', 'country' => 'US', 'location' => 'El Paso'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Tx93f5whKEM', 'country' => 'BR', 'location' => 'Belo Horizonte'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=hVOwjQroRx4', 'country' => 'HN', 'location' => 'San Pedro Sula'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=gu4VKEGP0Ks', 'country' => 'IL', 'location' => 'Jerusalem'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=DrBNxwHnYwE', 'country' => 'US', 'location' => 'Daphne'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=h9poAJUE-Dc', 'country' => 'AR', 'location' => 'Corrientes'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=xbShTTc0TjI', 'country' => 'SK', 'location' => 'Banska Bystrica'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=EXsJK9hcEHo', 'country' => 'ID', 'location' => 'Jakarta'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=koD-NUZ5dQw', 'country' => null, 'location' => 'Holy Spirit'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=gFPDQ8kZnpQ', 'country' => 'JO', 'location' => 'Amman'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=mLTV7jvKqbI', 'country' => 'BR', 'location' => 'Itajave'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Dln37StHSeo', 'country' => 'ES', 'location' => 'Madrid'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Ppk1uoy-OdA', 'country' => 'AR', 'location' => 'Buenos Aires'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=kCXQA1dVe1k', 'country' => 'KE', 'location' => 'Nairobi'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=57OmeHOv6fM', 'country' => 'DE', 'location' => 'Berlin'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=SZ6QMpC-I0A', 'country' => 'MU', 'location' => 'Port Louis'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=cf3FLfddT8Q', 'country' => 'CL', 'location' => 'Lebu'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=GaPeqWKm2do', 'country' => 'FI', 'location' => 'Tampere'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=VEi8rWLdf-o', 'country' => 'BS', 'location' => 'Nassau'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=mLMwuhdF8ZI', 'country' => 'GB', 'location' => 'Bedford'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=OIPq8RW26o4', 'country' => 'ZA', 'location' => 'Thohoyandou'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=PsEVOyi2OXI', 'country' => 'MX', 'location' => 'Mexico City'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=-QtSwuLvB54', 'country' => 'BB', 'location' => 'Bridgetown'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=iH_d_ktnKW4', 'country' => 'SG', 'location' => 'Singapore'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=aafH-0KSgjQ', 'country' => 'IL', 'location' => 'Galilee'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=TdkMkjAZts8', 'country' => 'CH', 'location' => 'Aarau'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=O9uDM8jwXi8', 'country' => 'US', 'location' => 'Huntsville'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=5GUjbGN9xCM', 'country' => 'AU', 'location' => 'Tasmania'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=CtzzqrX49FY', 'country' => 'BE', 'location' => 'Brussels'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=wGhMg2v4pQI', 'country' => 'PA', 'location' => 'La Chorrera'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=20OoguQVet4', 'country' => 'PK', 'location' => 'Lahore'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=a8vng6l1Ye8', 'country' => 'HN', 'location' => 'San Pedro Sula'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=6K1OA8uu734', 'country' => 'KP', 'location' => 'Seoul'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=i-6M0ZvX4n8', 'country' => 'CA', 'location' => 'Toronto'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=XHGHqfGXBFU', 'country' => 'BI', 'location' => 'Bujumbura'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=BDoEHTyOdhs', 'country' => 'PR', 'location' => 'Ponce'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=W6gvgHAR9pE', 'country' => 'CO', 'location' => 'Bogota'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=EiyLLT6fTp0', 'country' => 'EC', 'location' => 'Ambato'],
//        ];
//
//        foreach ($videos as $video) {
//
//            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video['youtube_link'], $output_array);
//
//            if (isset($output_array[7])) {
//
//                $content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $output_array[7]);
//                parse_str($content, $ytarr);
//
//                $video['title'] = $ytarr['title'];
//                $video['slug'] = str_slug($ytarr['title']);
//                $video['youtube_image'] = 'https://img.youtube.com/vi/' . $output_array[7] . '/maxresdefault.jpg';
//            }
//
//            $video_model = (new \App\Models\Video())->create($video);
//
//            $video_model->channels()->attach(2);
//
//            try {
//                $content = file_get_contents($video['youtube_image']);
//
//                if ($content) {
//                    $video_model->addMediaFromUrl($video['youtube_image'])->toMediaCollection('youtube_image');
//                }
//            } catch (Exception $exception) {
//
//            }
//        }
//
//        $videos = [
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=20tI5wVa3fg', 'location' => 'Houston', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=EvG8i5HNGjQ', 'location' => 'Marilia', 'country' => 'BR'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=UbP-0doa0FY', 'location' => 'Orlando', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=LD7EQrq1W3I', 'location' => 'Buenos Aires', 'country' => 'AR'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=FyBXj6zVwUE', 'location' => 'Santa Clara', 'country' => 'CU'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=lii9TcDlTwc', 'location' => 'Little Rock', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=xZWrUy7292o', 'location' => 'CHIHUAHUA', 'country' => 'MX'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=h9Zx2ZZF4rY', 'location' => 'ORLANDO', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=qAaH6KLgJBs', 'location' => 'STUTTGART', 'country' => 'DE'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=f30Nbu-1Kcg', 'location' => 'MANAGUA', 'country' => 'NI'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=_TqHJW-TAQ8', 'location' => 'DALLAS', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Dc3AoecraBQ', 'location' => 'MEXICO CITY', 'country' => 'MX'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=BJaKQ_LQf1s', 'location' => 'OKLAHOMA CITY', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=0iunSt3d3KQ', 'location' => 'TORONTO', 'country' => 'CA'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=_gm87heWSP8', 'location' => 'PROVIDENCE', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=GDlLEcV5gYc', 'location' => 'SAN PEDRO SULA', 'country' => 'HN'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=XO4RiaiS-m0', 'location' => 'DENVER', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=l-JCIMr2GbE', 'location' => 'POPAYAN', 'country' => 'CO'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=-DIJfhtt_ac', 'location' => 'WAXAHACHIE', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=FkgzrGfrFs8', 'location' => 'CIUDAD OBREGON', 'country' => 'MX'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=y5zQd0-oDgA', 'location' => 'PALACIOS', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=_MpYn0l-FVg', 'location' => 'HOUSTON', 'country' => 'US'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=jx5kVK9OenA', 'location' => 'HERMOSILLO', 'country' => 'MX'],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=aB-iIFV9bEM', 'location' => 'HOUSTON', 'country' => 'US']
//        ];
//
//        foreach ($videos as $video) {
//
//            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video['youtube_link'], $output_array);
//
//            if (isset($output_array[7])) {
//
//                $content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $output_array[7]);
//                parse_str($content, $ytarr);
//
//                $video['title'] = $ytarr['title'];
//                $video['slug'] = str_slug($ytarr['title']);
//                $video['youtube_image'] = 'https://img.youtube.com/vi/' . $output_array[7] . '/maxresdefault.jpg';
//            }
//
//
//            $video_model = (new \App\Models\Video())->create($video);
//
//            $video_model->channels()->attach(3);
//
//            try {
//                $content = file_get_contents($video['youtube_image']);
//
//                if ($content) {
//                    $video_model->addMediaFromUrl($video['youtube_image'])->toMediaCollection('youtube_image');
//                }
//            } catch (Exception $exception) {
//
//            }
//        }
//
//        $videos = [
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=Odk1rEQ5ygc', 'location' => 'MOUNT OF OLIVES', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=jO90RzVSb4E', 'location' => 'MOUNT OF BEATITUDES', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=O2uv0RMAV5Q', 'location' => 'MOUNT OF BEATITUDES', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=bPUV6yL9Sb8', 'location' => 'MOUNT OF TRANSFIGURATION', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=BWatH8OGRqE', 'location' => 'TEMPLE MOUNT', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=n0cLvQpp9Vc', 'location' => 'MOUNT ZION', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=d-eTQmUy4Jk', 'location' => 'JERUSALEM', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=pZRUNP1tFrY', 'location' => 'JERICHO', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=C4dRrbClBmQ', 'location' => 'SEA OF GALILEE', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=-ApA7b6kuu0', 'location' => 'NAIN', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=cy2zSGszVlI', 'location' => 'CAPERNAUM', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=MG5kEbNgt6g', 'location' => 'NAZARETH', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=JmuvXSuxpjA', 'location' => 'JUDEAN DESERT', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=blEHh6PNZyU', 'location' => 'THE JORDAN RIVER', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=2o6-Jb2Pv14', 'location' => 'DAYSTAR', 'country' => null],
//        ];
//
//        foreach ($videos as $video) {
//
//            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video['youtube_link'], $output_array);
//
//            if (isset($output_array[7])) {
//
//                $content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $output_array[7]);
//                parse_str($content, $ytarr);
//
//                $video['title'] = $ytarr['title'];
//                $video['location'] = ucfirst(strtolower($video['location']));
//                $video['slug'] = str_slug($ytarr['title']);
//                $video['youtube_image'] = 'https://img.youtube.com/vi/' . $output_array[7] . '/maxresdefault.jpg';
//            }
//
//            $video_model = (new \App\Models\Video())->create($video);
//
//            $video_model->channels()->attach(4);
//
//            try {
//                $content = file_get_contents($video['youtube_image']);
//
//                if ($content) {
//                    $video_model->addMediaFromUrl($video['youtube_image'])->toMediaCollection('youtube_image');
//                }
//            } catch (Exception $exception) {
//
//            }
//        }
//
//        $videos = [
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=C7jP3Do05aQ', 'location' => 'SALVATION', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=u2DGxfoIquM', 'location' => 'HOLY SPIRIT', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=xL-keZbmtzU', 'location' => 'DELIVERANCE', 'country' => null],
//            ['type' => 'youtube', 'youtube_link' => 'https://www.youtube.com/watch?v=hS9P6Jo_-6g', 'location' => 'HEALING', 'country' => null]
//        ];
//
//        foreach ($videos as $video) {
//
//            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $video['youtube_link'], $output_array);
//
//            if (isset($output_array[7])) {
//
//                $content = file_get_contents("http://youtube.com/get_video_info?video_id=" . $output_array[7]);
//                parse_str($content, $ytarr);
//
//                $video['title'] = $ytarr['title'];
//                $video['location'] = ucfirst(strtolower($video['location']));
//                $video['slug'] = str_slug($ytarr['title']);
//                $video['youtube_image'] = 'https://img.youtube.com/vi/' . $output_array[7] . '/maxresdefault.jpg';
//            }
//
//            $video_model = (new \App\Models\Video())->create($video);
//
//            $video_model->channels()->attach(5);
//
//            try {
//                $content = file_get_contents($video['youtube_image']);
//
//                if ($content) {
//                    $video_model->addMediaFromUrl($video['youtube_image'])->toMediaCollection('youtube_image');
//                }
//            } catch (Exception $exception) {
//
//            }
//        }


    }
}
