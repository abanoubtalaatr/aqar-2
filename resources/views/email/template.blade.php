<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <!--[if gte mso 9]>
 <xml>
  <o:OfficeDocumentSettings>
  <o:AllowPNG/>
  <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
 </xml>
 <![endif]-->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="format-detection" content="date=no" />
    <meta name="format-detection" content="address=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="x-apple-disable-message-reformatting" />
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i" rel="stylesheet" />
    <!--<![endif]-->
    <title>Email Template</title>
    <!--[if gte mso 9]>
 <style type="text/css" media="all">
  sup { font-size: 100% !important; }
 </style>
 <![endif]-->
    @if (myLang() == 'ar')
        <style>
            *,
            body {
                direction: rtl !important;
            }
        </style>
    @endif

    <style type="text/css" media="screen">
        /* Linked Styles */
        body {
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            background: #f4f4f4;
            -webkit-text-size-adjust: none
        }

        a {
            color: #66c7ff;
            text-decoration: none
        }

        p {
            padding: 0 !important;
            margin: 0 !important
        }

        img {
            -ms-interpolation-mode: bicubic;
            /* Allow smoother rendering of resized image in Internet Explorer */
        }

        .mcnPreviewText {
            display: none !important;
        }


        /* Mobile styles */
        @media only screen and (max-device-width: 480px),
        only screen and (max-width: 480px) {
            .mobile-shell {
                width: 100% !important;
                min-width: 100% !important;
            }

            .bg {
                background-size: 100% auto !important;
                -webkit-background-size: 100% auto !important;
            }

            .text-header,
            .m-center {
                text-align: center !important;
            }

            .center {
                margin: 0 auto !important;
            }

            .container {
                padding: 20px 10px !important
            }

            .td {
                width: 100% !important;
                min-width: 100% !important;
            }

            .m-br-15 {
                height: 15px !important;
            }

            .p30-15 {
                padding: 30px 15px !important;
            }

            .p40 {
                padding: 20px !important;
            }

            .m-td,
            .m-hide {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                font-size: 0 !important;
                line-height: 0 !important;
                min-height: 0 !important;
            }

            .m-block {
                display: block !important;
            }

            .fluid-img img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            .column,
            .column-top,
            .column-empty,
            .column-empty2,
            .column-dir-top {
                float: left !important;
                width: 100% !important;
                display: block !important;
            }

            .column-empty {
                padding-bottom: 10px !important;
            }

            .column-empty2 {
                padding-bottom: 20px !important;
            }

            .content-spacing {
                width: 15px !important;
            }
        }
    </style>
</head>

<body class="body"
    style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f4f4f4; -webkit-text-size-adjust:none;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f4f4f4">
        <tr>
            <td align="center" valign="top">
                <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                    <tr>
                        <td class="td container"
                            style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:55px 0px;">
                            <!-- Header -->
                            {{-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td class="p30-15" style="padding: 25px 30px 25px 30px;"
                                                    bgcolor="#ffffff">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <th class="column-top" width="145"
                                                                style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                    cellpadding="0">
                                                                    <tr>
                                                                        <td class="img m-center"
                                                                            style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                            <img src="{{ dashboardAsset('images/logo.png') }}"
                                                                                width="167" height="31"
                                                                                border="0" alt="" />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </th>
                                                            <th class="column-empty" width="1"
                                                                style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
                                                            </th>

                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table> --}}
                            <!-- END Header -->

                            <!-- Intro -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td background="images/t8_bg.jpg" bgcolor="#114490" valign="top"
                                                    height="100" class="bg"
                                                    style="background-size:cover !important; -webkit-background-size:cover !important; background-repeat:none;">
                                                    <!--[if gte mso 9]>
             <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:650px; height: 366px">
              <v:fill type="frame" src="images/t8_bg.jpg" color="#114490" />
              <v:textbox inset="0,0,0,0">
             <![endif]-->
                                                    <div>
                                                        <table width="100%" border="0" cellspacing="0"
                                                            cellpadding="0">
                                                            <tr>
                                                                <td class="content-spacing" width="30"
                                                                    height="100"
                                                                    style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                </td>
                                                                <td style="padding: 30px 0px;">
                                                                    <table width="100%" border="0" cellspacing="0"
                                                                        cellpadding="0">
                                                                        <tr>
                                                                            <td class="h1 center pb25"
                                                                                style="color:#ffffff; font-family:'Noto Sans', Arial,sans-serif; font-size:40px; line-height:46px; text-align:center; padding-bottom:25px;">
                                                                                {{ env('APP_NAME') }}</td>
                                                                        </tr>

                                                                    </table>
                                                                </td>
                                                                <td class="content-spacing" width="30"
                                                                    style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!--[if gte mso 9]>
              </v:textbox>
              </v:rect>
             <![endif]-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="mp15" style="padding: 20px 30px;" bgcolor="#a4ca0d"
                                                    align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                        
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- END Intro -->

                            <!-- Article / Title + Copy + Button -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                            bgcolor="#ffffff">
                                            <tr>
                                                @yield('content')
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
 
                            <!-- Footer -->
                            {{-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="p30-15" style="padding: 50px 30px;" bgcolor="#ffffff">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="padding-bottom: 30px;">
                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td class="img" width="55"
                                                                style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                <a href="{{ Setting('facebook') }}"
                                                                    target="_blank"><img
                                                                        src="{{ dashboardAsset('images/facebook.png') }}"
                                                                        width="38" height="38" border="0"
                                                                        alt="" /></a>
                                                            </td>
                                                            <td class="img" width="55"
                                                                style="font-size:0pt; line-height:0pt; text-align:left;">
                                                                <a href="{{ Setting('twitter') }}"
                                                                    target="_blank"><img
                                                                        src="{{ dashboardAsset('images/twitter.png') }}"
                                                                        width="38" height="38" border="0"
                                                                        alt="" /></a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-footer1 pb10"
                                                    style="color:#999999; font-family:'Noto Sans', Arial,sans-serif; font-size:16px; line-height:20px; text-align:center; padding-bottom:10px;">
                                                    @lang('Find us on social media')
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td class="text-footer2 pb30"
                                                    style="color:#999999; font-family:'Noto Sans', Arial,sans-serif; font-size:12px; line-height:26px; text-align:center; padding-bottom:30px;">
                                                    {{ setting('location_' . myLang()) }}</td>
                                            </tr>   --}}
                                            {{-- <tr>
                                                <td class="text-footer3"
                                                    style="color:#c0c0c0; font-family:'Noto Sans', Arial,sans-serif; font-size:12px; line-height:18px; text-align:center;">
                                                    <a href="#" target="_blank" class="link3-u"
                                                        style="color:#c0c0c0; text-decoration:underline;"><span
                                                            class="link3-u"
                                                            style="color:#c0c0c0; text-decoration:underline;">Unsubscribe</span></a>
                                                    from this mailing list.
                                                </td>
                                            </tr> --}}
                                        {{-- </table>
                                    </td>
                                </tr>
                            </table>   --}}
                            <!-- END Footer -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
