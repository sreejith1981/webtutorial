<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\EmailsType;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use AppBundle\Service\FileUploader;

class EmailsController extends Controller
{
    /**
     * @Route("/home", name="send_email")
     */
    public function indexAction(Request $request, FileUploader $fileUploader) {
        $defaultData = array('message' => 'Type your message here');
        $form = $this->createForm(EmailsType::class, $defaultData);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $mail = new PHPMailer(true);                                // Passing `true` enables exceptions

            // Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->SMTPAuth = true;                                     // Enable SMTP authentication
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Host = 'smtp.gmail.com';                             // Specify main and backup SMTP servers
            $mail->Port = 587;                                          // TCP port to connect to
            $mail->Username = 'vinsreejith@gmail.com';                  // SMTP username
            $mail->Password = 'Admin@123';                              // SMTP password

            // Recipients
            $mail->setFrom('vinsreejith@gmail.com', 'sreejith vin');
            // $mail->FromName = 'From';
            $mail->addReplyTo('vinsreejith@gmail.com', 'sreejith vin');
            // $mail->addAddress('joe@example.net', 'Joe User');        // Add a recipient
            $mail->addAddress($data["recipientAddress"]);               // Name is optional
            $cc = $data["cc"];
            if(strlen(trim($cc)) != 0) {
                $mail->addCC($cc);
            }
            $bcc = $data["bcc"];
            if(strlen(trim($data["bcc"])) != 0) {
                $mail->addBCC($bcc);
            }

            // Attachments
            $file = $form['attachment']->getData();
            if(strlen(trim($file)) != 0) {
                $fileName = $fileUploader->upload($file);
                $filePath = $fileUploader->getTargetDirectory().'/'.$fileName;
                $mail->addAttachment($filePath);                          // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
            }

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $subject = $data["subject"];
            if(strlen(trim($subject)) != 0) {
                // $mail->Subject = 'Here is the subject';
                $mail->Subject = $subject;
            }
            $body = $data["body"];
            if(strlen(trim($body)) != 0) {
                // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->Body = $body;
            }
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


            if(!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            else {
                echo "Message has been sent successfully";

                //Section 2: IMAP
                //Uncomment these to save your message in the 'Sent Mail' folder.
                #if (save_mail($mail)) {
                #    echo "Message saved!";
                #}
            }

            return $this->redirectToRoute('send_email');
        }
        else {
            return $this->render('emailsViews/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }





    //Section 2: IMAP
    //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
    //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
    //You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
    //be useful if you are trying to get this working on a non-Gmail IMAP server.
    function save_mail($mail)
    {
        //You can change 'Sent Mail' to any other folder or tag
        $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $mail->Username, $mail->Password);
        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);
        return $result;
    }
}
?>
