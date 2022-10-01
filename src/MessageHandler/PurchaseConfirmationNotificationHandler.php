<?php

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]  // instead of implements MessageHandler new purpose in php 8
class PurchaseConfirmationNotificationHandler
{
        public function __invoke(PurchaseConfirmationNotification $notification)
        {
             // 1. Create a PDF contract not
            echo 'Creating a PDF contract note ...<br>';

            // 2. Email contract note to the buyer

            echo 'Emailing contract note to ' . $notification->getOrder()->getBuyer()->getEmail() . '<br>';


        }
}
