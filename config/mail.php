<?php  

function send_new_smtp_attachment_mail($to, $subject, $description, $ccmail = [], $bccmail = [], $attfilename = [])
{
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $rs = GetPageRecord('*', 'sys_userMaster', 'id="1"');  
    $LoginUserDetails = mysqli_fetch_array($rs);

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = $LoginUserDetails['smtpServer'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $LoginUserDetails['emailAccount'];
        $mail->Password   = $LoginUserDetails['emailPassword'];
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($LoginUserDetails['emailAccount'], $LoginUserDetails['fromName']);

        // To
        if (is_array($to)) {
            foreach ($to as $t) {
                if (!empty($t)) {
                    $mail->addAddress(trim($t));
                }
            }
        } else {
            if (!empty($to)) {
                $mail->addAddress(trim($to));
            }
        }

        // CC
        if (!empty($ccmail)) {
            if (is_array($ccmail)) {
                foreach ($ccmail as $cc) {
                    if (!empty($cc)) {
                        $mail->addCC(trim($cc));
                    }
                }
            } else {
                $mail->addCC(trim($ccmail));
            }
        }

        // BCC
        if (!empty($bccmail)) {
            if (is_array($bccmail)) {
                foreach ($bccmail as $bcc) {
                    if (!empty($bcc)) {
                        $mail->addBCC(trim($bcc));
                    }
                }
            } else {
                $mail->addBCC(trim($bccmail));
            }
        }

        // Attachments
        if (!empty($attfilename)) {
            if (is_array($attfilename)) {
                foreach ($attfilename as $file) {
                    if (file_exists('attachments/'.$file)) {
                        $mail->addAttachment('attachments/'.$file);
                    }
                }
            } else {
                if (file_exists('attachments/'.$attfilename)) {
                    $mail->addAttachment('attachments/'.$attfilename);
                }
            }
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $description;
        $mail->AltBody = strip_tags($description);

        $status = false;

        if ($mail->send()) {
            // Save copy in Sent folder
            $imapPath   = "{".$LoginUserDetails['imapServer'].":".$LoginUserDetails['imapPort']."/".$LoginUserDetails['securityType']."}INBOX.Sent";
            $imapStream = @imap_open($imapPath, $LoginUserDetails['emailAccount'], $LoginUserDetails['emailPassword']);

            if ($imapStream) {
                $mimeMessage = $mail->getSentMIMEMessage();
                imap_append($imapStream, $imapPath, $mimeMessage);
                imap_close($imapStream);
            }

            $status = true;
        }

        // ✅ Clear all recipients and attachments after sending
        $mail->clearAddresses();
        $mail->clearCCs();
        $mail->clearBCCs();
        $mail->clearAttachments();

        return $status;

    } catch (Exception $e) {
        error_log("Mail Error: ".$mail->ErrorInfo);
        return false;
    }
}

 
 
 
 
function send_attachment_mail($to,$subject,$description,$ccmail)  
{  

$description='<div style="width:100%;background-color: #f7f7fe; padding:30px 0px;"><div style="max-width: 600px;padding: 20px; padding-top: 10px; padding-right: 20px; padding-bottom: 10px; padding-left: 20px; background-color:#FFFFFF;margin: auto;">'.$description.'</div></div>'; 
 
send_new_smtp_attachment_mail($to,stripslashes($subject),stripslashes($description),$ccmail); 
  
 
}

?>