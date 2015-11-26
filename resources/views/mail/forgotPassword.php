<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <style type="text/css">
        /* Client-specific Styles */
        #outlook a {
            padding: 0;
        }

        /* Force Outlook to provide a "view in browser" button. */
        body {
            width: 100% !important;
        }

        /* Force Hotmail to display emails at full width */
        body {
            -webkit-text-size-adjust: none;
            font-family: helvetica;
        }

        /* Prevent Webkit platforms from changing default text sizes. */

        /* Reset Styles */

        body {
            margin: 0;
            padding: 0;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table td {
            border-collapse: collapse;
        }
    </style>
</head>
<body leftmargin="10" marginwidth="0" topmargin="0" marginheight="0">
    <h3>Password Reset</h3>
    <p>You recently requested a password reset for your account. If you did not make this request, simply ignore this email</p>
    <p>To reset your password, click the following link:</p>
    <br>
    <a href="<?= $resetLink ?>"><?= $resetLink ?></a>
    <br>
    <p>Thanks</p>
</body>
</html>
