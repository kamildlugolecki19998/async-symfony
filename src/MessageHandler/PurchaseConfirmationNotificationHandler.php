<?php

namespace App\MessageHandler;

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
        echo 'Creating a PDF contract note ...<br>';

        // 2. Email contract note to the buyer

//        echo 'Emailing contract note to ' . $notification->getOrder()->getBuyer()->getEmail() . '<br>';

        $email = (new Email())
            ->from('sales@stock.com')
            ->to($notification->getOrder()->getBuyer()->getEmail())
            ->subject('Contract note for order' . $notification->getOrder()->getId())
            ->text('Here is your note');

        $this->mailer->send($email);
    }
}
