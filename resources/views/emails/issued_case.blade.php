@extends('emails.template')

@section('content')
<body width="100%" bgcolor="#222222" style="margin: 0;">
    <center style="width: 100%; background: #222222;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            {{ trans('email.orders.issued_case.message1') }}
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--    
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 559px.
            2. MSO tags for Desktop Windows Outlook enforce a 559px width.
            Note: The Fluid and Responsive templates have a different width (559px). The hybrid grid is more "fragile", and I've found that 559px is a good width. Change with caution.  
        -->
        <div style="max-width: 559px; margin: auto;">
            <!--[if mso]>
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="559" align="center">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Header : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 559px;">
                <tr>
                    <td style="padding: 20px 0; text-align: center">
                    	<!--    <img src="http://placehold.it/200x50" width="200" height="50" alt="alt_text" border="0" style="background: #dddddd; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"> -->
                    </td>
                </tr>
            </table>
            <!-- Email Header : END -->
            
            <!-- Email Body : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 559px;">
                
                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <img src="{{ $data['img_header'] }}" width="559" height="300" alt="alt_text" border="0" align="center" class="fluid" style="width: 100%; max-width: 559px; background: #dddddd; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px; text-align: justify; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                
                                    {!! $data['body_message'] !!}

                                    <!-- Button : Begin -->
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto">
                                        <tr>
                                            <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                                                <!-- <a href="http://yezz.world/encuesta/?token1=pbt5p7vCNMQ" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ffffff">Encuesta</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                </a>-->
                                                <a href="{{ $data['url_ext_link'] }}"><img src="{{ $data['img_ext_link'] }}" width="230" height="70" alt="VOTE" border="0" align="center" class="fluid" style="width: 100%; max-width: 230px; background: #dddddd; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;"></a>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Button : END -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : BEGIN -->

                <!-- Clear Spacer : BEGIN -->
                <tr>
                    <td height="40" style="font-size: 0; line-height: 0;">
                        &nbsp;
                    </td>
                </tr>
                <!-- Clear Spacer : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <!-- <tr>
                    <td bgcolor="#ffffff">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555;">
                                    Maecenas sed ante pellentesque, posuere leo id, eleifend dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent laoreet malesuada cursus. Maecenas scelerisque congue eros eu posuere. Praesent in felis ut velit pretium lobortis rhoncus ut&nbsp;erat.
                                </td>
                                </tr>
                        </table>
                    </td>
                </tr> -->
                <!-- 1 Column Text + Button : BEGIN -->

            </table>
            <!-- Email Body : END -->
          
            <!-- Email Footer : BEGIN -->
            <!-- <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 559px;">
                <tr>
                    <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; mso-height-rule: exactly; line-height:18px; text-align: center; color: #888888;">
                        <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>
                        <br><br>
                        Company Name<br><span class="mobile-link--footer">123 Fake Street, SpringField, OR, 97477 US</span><br><span class="mobile-link--footer">(123) 456-7890</span>
                        <br><br>
                        <unsubscribe style="color:#888888; text-decoration:underline;">unsubscribe</unsubscribe>
                    </td>
                </tr>
            </table> -->
            <!-- Email Footer : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
    </center>
</body>
@endsection