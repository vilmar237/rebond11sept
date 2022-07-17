<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Identifiant de connexion à {{setting('company_name')}}</title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <!-- Web Font / @font-face : BEGIN -->
    <!--[if mso]>
        <style>
            * {
                font-family: 'Roboto', sans-serif !important;
            }
        </style>
    <![endif]-->

    <!--[if !mso]>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    
    
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color:#8094ae;
            font-weight: 400;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }
        a {
            text-decoration: none;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
	<center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding-bottom:25px">
                                    <a href="#"><img style="height: 40px" src="http://localhost:8000/{{public_path('assets/img/sopecam.png')}}" alt="logo"></a>
                                    <p style="font-size: 14px; color: #6576ff; padding-top: 12px;">Indentifiants d'accès à {{setting('company_name')}}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding: 50px 30px;">
                                    <img style="width:88px; margin-bottom:24px;" src="http://localhost:8000/{{public_path('assets/img/kyc-success.png')}}" alt="In Process">
                                    <h2 style="font-size: 18px; color: #6576ff; font-weight: 400; margin-bottom: 8px;">Salut {{ucfirst($username)}}.</h2>
                                    <p>Bienvenue à l'outil de collaboration de {{setting('company_name')}}. Vos identifiant d'accès sont les suivants :</p>
                                    <p>Email : {{ $mail }}</p>
                                    <p>Mot de passe (à modifier après votre première connexion): {{ $passw }}</p>
                                    <p style="margin-bottom: 25px;">Ce lien expirera dans 15 minutes et ne peut être utilisé qu'une seule fois.</p>
                                    <a href="{{ $link }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 30px">Verifier votre compte</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 30px">
                                    <h4 style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">ou</h4>
                                    <p style="margin-bottom: 10px;">Si le bouton ci-dessus ne fonctionne pas, collez ce lien dans votre navigateur Web :</p>
                                    <a href="#" style="color: #6576ff; text-decoration:none;word-break: break-all;">{{ $link }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding:25px 20px 0;">
                                    <p style="font-size: 13px;">Copyright © {{ Date('Y') }} {{setting('company_name')}}. {{setting('site_copyright')}}. <br> Conçu par {{setting('company_name')}} <a style="color: #6576ff; text-decoration:none;" href="{{setting('site_url')}}">{{setting('company_name')}}</a>.</p>
                                    <ul style="margin: 10px -4px 0;padding: 0;">
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="#"><img style="width: 30px" src="http://localhost:8000/{{public_path('assets/img/facebook.png')}}" alt="brand"></a></li>
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="#"><img style="width: 30px" src="http://localhost:8000/{{public_path('assets/img/twitter.png')}}" alt="brand"></a></li>
                                    </ul>
                                    <p style="padding-top: 15px; font-size: 12px;">Ce mail vous a été envoyé en tant qu'utilisateur enregistré de <a style="color: #6576ff; text-decoration:none;" href="{{setting('site_url')}}">rebond.cm</a>. Pour mettre à jour vos préférences d'e-mails <a style="color: #6576ff; text-decoration:none;" href="#">cliquer ici</a>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
            </tr>
        </table>
    </center>
</body>
</html>