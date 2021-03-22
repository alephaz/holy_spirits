<!-- Emails use the XHTML Strict doctype -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- The character set should be utf-8 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <!-- Link to the email's CSS, which will be inlined into the email -->
    <link rel="stylesheet" href="/css/email/foundation-emails.css">
</head>
<body>
<table class="body">
    <tr>
        <td align="center" class="center" valign="top">
            <center data-parsed="">
                <table align="center" class="wrapper header float-center">
                    <tr>
                        <td class="wrapper-inner">
                            <table align="center" class="container">
                                <tbody>
                                <tr>
                                    <td>
                                        <table class="row collapse">
                                            <tbody>
                                            <tr>
                                                <th class="small-6 large-6 columns first" valign="middle">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                                <table>
                                                                    <tr>
                                                                        <td width="62"><img
                                                                                    src="https://www.abm.cc/img/logo.png"
                                                                                    style="width: 52px;">
                                                                        </td>
                                                                        <td valign="middle" class="logo-text">ANDRES
                                                                            BISONNI <br>MINISTRIES
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-6 large-6 columns first" valign="middle">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                                <table class="button" align="right">
                                                                    <tr>
                                                                        <td>
                                                                            <table align="right">
                                                                                <tr>
                                                                                    <td>
                                                                                        @if($data['language'] === 'en')
                                                                                            <a href="https://www.abm.cc/partnership"><img
                                                                                                        src="https://www.abm.cc/img/partner-withus.png"
                                                                                                        width="156"></a>
                                                                                        @endif
                                                                                        @if($data['language'] === 'es')
                                                                                            <a href="https://www.abm.cc/partnership"><img
                                                                                                        src="https://www.abm.cc/img/partner-withus-es.png"
                                                                                                        width="195"></a>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
                <table align="center" class="container float-center">
                    <tbody>
                    <tr>
                        <td>
                            <table class="row">
                                <tbody>
                                <tr>
                                    <th class="small-12 large-12 columns first last">
                                        @foreach(['a', 'b', 'c'] as $block_id)
                                            <table>
                                                <tr>
                                                    <th>
                                                        <h2>{!! $data['block_'.$block_id.'_title'] !!}</h2>
                                                        @if($data['block_'.$block_id.'_video'])
                                                            <a href="{{ $data['block_'.$block_id.'_video']['link'] }}"
                                                               target="_blank"><img
                                                                        src="{{ $data['block_'.$block_id.'_video']['image'] }}"
                                                                        width="500"
                                                                        style="width: 100%; max-width: 548px;"/></a>
                                                        @endif
                                                        <table class="large secondary">
                                                            <tr>
                                                                <td>
                                                                    @if($data['block_'.$block_id.'_custom_image'])
                                                                        <table>
                                                                            <tr>
                                                                                <td class="pt-10">
                                                                                    <a href="{!! $data['block_'.$block_id.'_custom_image']['url'] !!}">
                                                                                        <img src="{{ $data['block_'.$block_id.'_custom_image']['image'] }}"
                                                                                             alt="{{ $data['block_'.$block_id.'_title'] }}" width="500"
                                                                                             style="width: 100%; max-width: 548px;"/>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="large secondary">
                                                            <tr>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td class="pt-10">
                                                                                {!! $data['block_'.$block_id.'_body'] !!}
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class="large secondary">
                                                            <tr>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td class="pt-10">
                                                                                <a href="{!! $data['block_'.$block_id.'_link'] !!}">{!! $data['block_'.$block_id.'_link'] !!}</a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                    <th class="expander"></th>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                            <!-- Footer -->
                            <table align="center" class="wrapper secondary">
                                <tr>
                                    <td class="wrapper-inner">
                                        <table class="spacer">
                                            <tbody>
                                            <tr>
                                                <td height="16px" style="font-size:16px;line-height:16px;"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="newbook">
                                            <tbody>
                                            <tr>
                                                <td width="180" style="max-width: 180px;"><img src="https://www.abm.cc//img/book.png" width="180"
                                                                                               style="width: 100%; max-width: 180px;"></td>
                                                <td>
                                                    @if($data['language'] === 'en')
                                                        <h5>New Book</h5>
                                                        <p>Experience the wonder of knowing and loving the Spirit of God
                                                            and discover the secrets to being used by <br> His power. Receive
                                                            the book,
                                                            "My Beloved Holy Spirit," written by Andres Bisonni as a
                                                            thank you gift when you partner with the ministry.</p>
                                                    @endif
                                                    @if($data['language'] === 'es')
                                                        <h5>Nuevo Libro</h5>
                                                        <p>Experimenta la belleza de conocer y amar al Espíritu de Dios
                                                            y descubre los secretos de como ser usado por Su poder.
                                                            Recibe el libro, "Mi Amado Espíritu Santo," escrito por
                                                            Andrés Bisonni, como un regalo en agradecimiento por
                                                            patrocinar el ministerio.</p>
                                                    @endif


                                                    <table class="button secondary" height="70">
                                                        <tr>
                                                            <td>
                                                                <table align="right">
                                                                    <tr>
                                                                        <td>
                                                                            @if($data['language'] === 'en')
                                                                                <a href="https://www.abm.cc/partnership">
                                                                                    <img src="https://www.abm.cc/img/more-info.png" width="99">
                                                                                </a>
                                                                            @endif

                                                                            @if($data['language'] === 'es')
                                                                                <a href="https://www.abm.cc/partnership">
                                                                                    <img src="https://www.abm.cc/img/more-info-es.png" width="99">
                                                                                </a>
                                                                            @endif

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="spacer">
                                            <tbody>
                                            <tr>
                                                <td height="16px" style="font-size:16px;line-height:16px;"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="row">
                                            <tbody>
                                            <tr>
                                                <th class="small-12 large-12 columns first">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                                <table align="left" class="menu vertical">
                                                                    <tr>
                                                                        <td>
                                                                            <table>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="text-center">
                                                                                        <a href="https://www.youtube.com/user/andresabm"
                                                                                           style="display: inline-block">
                                                                                            <img src="https://www.abm.cc//img/social-yt.png"
                                                                                                 alt=""/> </a>
                                                                                        <a href="https://www.facebook.com/andresabm/"
                                                                                           style="display: inline-block">
                                                                                            <img src="https://www.abm.cc/img/social-fb.png"
                                                                                                 alt=""/> </a>
                                                                                        <a href="https://twitter.com/andresabm"
                                                                                           style="display: inline-block">
                                                                                            <img src="https://www.abm.cc//img/social-tw.png"
                                                                                                 alt=""/> </a>
                                                                                        <a href="https://www.instagram.com/andresbisonni/"
                                                                                           style="display: inline-block">
                                                                                            <img src="https://www.abm.cc/img/social-ig.png"
                                                                                                 alt=""/> </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </center>
        </td>
    </tr>
</table>
</body>
</html>