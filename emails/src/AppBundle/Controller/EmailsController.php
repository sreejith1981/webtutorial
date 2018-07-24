<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Form\EmailsType;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';

class EmailsController extends Controller
{
    /**
     * @Route("/home", name="send_email")
     */
    public function indexAction(Request $request) {
        $defaultData = array('message' => 'Type your message here');
        $form = $this->createForm(EmailsType::class, $defaultData);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vinsreejith@gmail.com';
            $mail->Password = 'Admin@123';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->addAddress($data["recipientAddress"]);
            $cc = $data["cc"];
            if(strlen(trim($cc)) != 0) {
                $mail->addCC($cc);
            }
            $bcc = $data["bcc"];
            if(strlen(trim($data["bcc"])) != 0) {
                $mail->addBCC($bcc);
            }

            //Attachments
            $attach = $data["attachment"];
            if(strlen(trim($attach)) != 0) {
                $mail->addAttachment($attach);
            }

            //Content
            $mail->isHTML(true);
            $subject = $data["subject"];
            if(strlen(trim($subject)) != 0) {
                $mail->Subject = $subject;
            }
            $body = $data["body"];
            if(strlen(trim($body)) != 0) {
                $mail->Body = $body;
            }


            if(!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            else {
                echo "Message has been sent successfully";
            }

            return $this->redirectToRoute('send_email');
        }
        else {
            return $this->render('emailsViews/index.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }
}
?>
