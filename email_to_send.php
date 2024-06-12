<?php
// Include PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Define secure SMTP credentials (make sure to replace placeholders)
$smtpUsername = 'your-email@gmail.com';
$smtpPassword = 'your-email-password';

// Define the `generateToken` function
function generateToken() {
    return bin2hex(random_bytes(32));
}

// Define the `sendEmail` function
function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // PHPMailer configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nj954385@gmail.com';
        $mail->Password = 'hqcy fxru juai gfpa';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Set email details
        $mail->setFrom('nj954385@gmail.com', 'Neha jaiswal');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $body;
        
        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Handle exceptions by printing error message
        echo 'Failed to send email: ' . $mail->ErrorInfo;
        return false;
    }
}

// Sender and recipient
$to = 'nj954385@gmail.com';
$subject = 'Test Email';
$message = '<div style="background-color:#f7f7f7; font-variant:JIS04; margin-bottom:0; margin-left:auto; margin-right:auto; margin-top:0; max-width:560px">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; width:100%">
<tbody>
<tr>
<td style="background-color:#fafafa; border-bottom:0; border-top:0; vertical-align:top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="templateContainer" style="background:#ecf4de none repeat scroll 0% 0%; border-collapse:collapse; max-width:600px ! important; width:100%">
<tbody>
<tr>
<td style="vertical-align:top">
<table border="0" cellpadding="0" cellspacing="0" class="mcnTextBlock" style="border-collapse:collapse; min-width:100%; width:100%">
<tbody>
<tr>
<td style="vertical-align:top">
<table align="center " border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse:collapse; width:600px">
<tbody>
<tr>
<td style="text-align:center; vertical-align:top"><img alt="Lyvup" class="mcnImage" src="https://app.lyvup.com/images/lyvupLogo.png" style="border:0px; display:inline !important; max-width:185px; outline:none; padding-bottom:0px; padding:3px; text-decoration:none; vertical-align:bottom; width:140px" /></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="background-color:#0ea2d7; border-bottom:0; border-top:0">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="templateContainer" style="border-collapse:collapse; max-width:600px ! important; width:100%">
<tbody>
<tr>
<td style="vertical-align:top">
<table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse:collapse; min-width:100%; width:100%">
<tbody>
<tr>
<td style="text-align:left; vertical-align:center">
<h1 style="text-align:center"><span style="color:#ffffff">{message_title}</span></h1>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="border-bottom:0; border-top:0; vertical-align:top">&nbsp;</td>
</tr>
<tr>
<td style="background-color:#ffffff; border-bottom:0; border-top:0; vertical-align:top"><!--[if gte mso 9]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
                           <tr>
                              <td align="center" valign="top" width="600" style="width:600px;">
                                 <![endif]-->{message_body}<!--[if gte mso 9]>
                              </td>
                           </tr>
                        </table>
                        <![endif]--></td>
</tr>
<tr>
<td style="border-bottom:0; border-top:0; vertical-align:top">&nbsp;</td>
</tr>
<tr>
<td style="background-color:#0ea2d7; border-bottom:0; border-top:0">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="templateContainer" style="border-collapse:collapse; max-width:600px ! important; width:100%">
<tbody>
<tr>
<td style="vertical-align:top">
<table align="left" border="0" cellpadding="0" cellspacing="0" class="mcnTextContentContainer" style="border-collapse:collapse; min-width:100%; width:100%">
<tbody>
<tr>
<td style="text-align:center"><span style="color:#ffffff">2021 &copy;&nbsp;</span><a href="https://app.lyvup.com/" target="_blank"><span style="color:#ffffff">Lyvup</span></a><span style="color:#ffffff">&nbsp;Alle Rechten Voorbehouden</span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>';
$headers = 'From: nj954385@gmail.com' . "\r\n" .
    'Reply-To: nj954385@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}
?>




