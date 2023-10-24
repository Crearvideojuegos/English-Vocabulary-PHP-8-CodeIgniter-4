<?php

namespace App\Libraries\Emails;

class EmailsUser
{
    function email_welcome_register($user_nickname, $user_email, $code_for_activation)
    {

        if(ENVIRONMENT === 'production')
		{
            $email = \Config\Services::email();

            $message = '
            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <!--[if mso]>
                <style>
                table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                div, td {padding:0;}
                div {margin:0 !important;}
                </style>
                <noscript>
                <xml>
                    <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                </noscript>
                <![endif]-->
                <style>
                    table, td, div, h1, p {
                        font-family: Arial, sans-serif;
                    }
                    @media screen and (max-width: 530px) {
                        .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #7D1441;
                        text-decoration: none !important;
                        font-weight: bold;
                        }
                        .col-lge {
                        max-width: 100% !important;
                        }
                    }
                    @media screen and (min-width: 531px) {
                        .col-sml {
                        max-width: 27% !important;
                        }
                        .col-lge {
                        max-width: 73% !important;
                        }
                    }
                </style>
            </head>
            <body style="margin:0;padding:0;word-spacing:normal;background-color:#7D1441;">
                <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#7D1441;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                        <tr>
                        <td align="center" style="padding:0;">
                            <!--[if mso]>
                            <table role="presentation" align="center" style="width:600px;">
                            <tr>
                            <td>
                            <![endif]-->
                            <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                                <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://www.improveenglishvocabulary.com/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/logo.png" width="165" alt="Logo" style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Welcome to Improve English Vocaulary</h1>
                                <p style="margin:0;">Thank you for registering in Improve English Vocabulary.</p>
                                <br>
                                <p style="margin:0;">
                                    To validate your email and be able to access, <a href="https://www.improveenglishvocabulary.com/register/email-activation/'.$code_for_activation.'" style="color:#e50d70;text-decoration:underline;">click here.</a></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
                                <a href="https://www.improveenglishvocabulary.com/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/welcome-email-image.jpg" width="600" alt="" style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:30px;text-align:center;font-size:12px;background-color:#ffffff;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                    <a href="https://twitter.com/iwritegames" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/twitter.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                    <a href="https://www.instagram.com/iwritegames/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/instagram.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                    <a href="https://www.linkedin.com/in/alejandro-lujan-garcia/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/linkedin.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                </p>
                                </td>
                            </tr>
                            </table>
                            <br>
                            <br>
                            <!--[if mso]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                        </tr>
                    </table>
                </div>
            </body>
            </html>
            ';

            $email->setTo($user_email);
            $email->setFrom('admin@improveenglishvocabulary.com', 'Confirm Registration');
            $email->setSubject('Welcome Improve English Vocabulary, '.$user_nickname.'');
            $email->setMessage($message);
            $email->send();
		}

    } //End Welcome Register

    function email_recovery_password($user_email, $code_for_recovery)
    {

        if(ENVIRONMENT === 'production')
		{
            $email = \Config\Services::email();

            $message = '
            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <!--[if mso]>
                <style>
                table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                div, td {padding:0;}
                div {margin:0 !important;}
                </style>
                <noscript>
                <xml>
                    <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                </noscript>
                <![endif]-->
                <style>
                    table, td, div, h1, p {
                        font-family: Arial, sans-serif;
                    }
                    @media screen and (max-width: 530px) {
                        .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #7D1441;
                        text-decoration: none !important;
                        font-weight: bold;
                        }
                        .col-lge {
                        max-width: 100% !important;
                        }
                    }
                    @media screen and (min-width: 531px) {
                        .col-sml {
                        max-width: 27% !important;
                        }
                        .col-lge {
                        max-width: 73% !important;
                        }
                    }
                </style>
            </head>
            <body style="margin:0;padding:0;word-spacing:normal;background-color:#7D1441;">
                <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#7D1441;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                        <tr>
                        <td align="center" style="padding:0;">
                            <!--[if mso]>
                            <table role="presentation" align="center" style="width:600px;">
                            <tr>
                            <td>
                            <![endif]-->
                            <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                                <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://www.improveenglishvocabulary.com/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/logo.png" width="165" alt="Logo" style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:30px;background-color:#ffffff;">
                                <h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Recovery password - Improve English Vocabulary</h1>
                                <p style="margin:0;">
                                    To create a new password, click on the following link <a href="https://www.improveenglishvocabulary.com/login/new-password/'.$code_for_recovery.'" style="color:#e50d70;text-decoration:underline;">Recovery Password.</a>
                                </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
                                <a href="https://www.improveenglishvocabulary.com/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/recovery-password-image.jpg" width="600" alt="" style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:30px;text-align:center;font-size:12px;background-color:#ffffff;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                    <a href="https://twitter.com/iwritegames" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/twitter.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                    <a href="https://www.instagram.com/iwritegames" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/instagram.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                    <a href="https://www.linkedin.com/in/alejandro-lujan-garcia/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/linkedin.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                </p>
                                </td>
                            </tr>
                            </table>
                            <br>
                            <br>
                            <!--[if mso]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                        </tr>
                    </table>
                </div>
            </body>
            </html>     
            ';

            $email->setTo($user_email);
            $email->setFrom('admin@improveenglishvocabulary.com', 'Recovery Password');
            $email->setSubject('Recovery Password From Improve English Vocabulary');
            $email->setMessage($message);
            $email->send();
		}

    } // End Recovery Password


    function email_export($user_email, $words_table, $sentences_table)
    {
        if (ENVIRONMENT === 'production') {
            $email = \Config\Services::email();

            $message = 
            '
            <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                <!--[if mso]>
                <style>
                table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
                div, td {padding:0;}
                div {margin:0 !important;}
                </style>
                <noscript>
                <xml>
                    <o:OfficeDocumentSettings>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
                </noscript>
                <![endif]-->
                <style>
                    table, td, div, h1, p {
                        font-family: Arial, sans-serif;
                    }
                    @media screen and (max-width: 530px) {
                        .unsub {
                        display: block;
                        padding: 8px;
                        margin-top: 14px;
                        border-radius: 6px;
                        background-color: #7D1441;
                        text-decoration: none !important;
                        font-weight: bold;
                        }
                        .col-lge {
                        max-width: 100% !important;
                        }
                    }
                    @media screen and (min-width: 531px) {
                        .col-sml {
                        max-width: 27% !important;
                        }
                        .col-lge {
                        max-width: 73% !important;
                        }
                    }
                </style>
            </head>
            <body style="margin:0;padding:0;word-spacing:normal;background-color:#7D1441;">
                <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#7D1441;">
                    <table role="presentation" style="width:100%;border:none;border-spacing:0;">
                        <tr>
                        <td align="center" style="padding:0;">
                            <!--[if mso]>
                            <table role="presentation" align="center" style="width:600px;">
                            <tr>
                            <td>
                            <![endif]-->
                            <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                            <tr>
                                <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="https://www.improveenglishvocabulary.com/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/logo.png" width="165" alt="Logo" style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                                </td>
                            </tr><tr>
                                <td style="padding:30px;text-align:center;font-size:12px;background-color:#ffffff;color:#cccccc;">
                                <p style="margin:0 0 8px 0;">
                                    <a href="https://twitter.com/iwritegames" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/twitter.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                    <a href="https://www.instagram.com/iwritegames/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/instagram.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                    <a href="https://www.linkedin.com/in/alejandro-lujan-garcia/" style="text-decoration:none;"><img src="https://improveenglishvocabulary.com/assets/img/email-icons/linkedin.png" target="_blank" width="40" height="40" alt="f" style="display:inline-block;color:#cccccc;"></a> 
                                </p>
                                </td>
                            </tr>
                            </table>
                            <br>
                            <br>
                            <!--[if mso]>
                            </td>
                            </tr>
                            </table>
                            <![endif]-->
                        </td>
                        </tr>
                    </table>


                    <table style="
                    padding: 50px;width: 100%;
                ">'
                        .$words_table.
                        '
                    </table>
<br>
                    <table style="
                    padding: 50px;
                ">'
                    .$sentences_table.
                    '
                </table>



                </div>
            </body>
            </html>
            ';

            $email->setTo($user_email);
            $email->setFrom('admin@improveenglishvocabulary.com', 'Export Info');
            $email->setSubject('Export Info Improve English Vocabulary');
            $email->setMessage($message);
            $email->send();

        }
    } 
    //End Email Export


}