<?php

namespace App\MessageHandler;

use Mpdf\Mpdf;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Mime\Email;


#[AsMessageHandler]  // instead of implements MessageHandler new purpose in php 8
class PurchaseConfirmationNotificationHandler
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(PurchaseConfirmationNotification $notification)
    {
        // 1. Create a PDF contract not

        $mpdf = new Mpdf();

        $content = "<h1> Contract Note For Order {$notification->getOrderId()}</h1>";
        $content .= '<p>Total: <b> $1898.25</b>></p>';

        $mpdf->writeHTML($content);

        $contractNotePdf = $mpdf->output('', 'S');


        //        echo 'Emailing contract note to ' . $notification->getOrder()->getBuyer()->getEmail() . '<br>';

        $email = (new Email())
            ->from('sales@stock.com')
            ->to('email@example.com')
            ->subject('Contract note for order' . $notification->getOrderId())
            ->text('Here is your note')
            ->attach($contractNotePdf, 'contract-note.pdf');

        $this->mailer->send($email);
    }
}
