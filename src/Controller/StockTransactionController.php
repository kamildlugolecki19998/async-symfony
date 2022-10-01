<?php

namespace App\Controller;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route as Route;


class StockTransactionController extends AbstractController
{

    #[Route('buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus): Response
    {
        //$notification->getOrder()->getBuyer()->getEmail() . '<br>';
        $order = new class {
            public function getBuyer(): object
            {
                return new class {
                    public function getEmail(): string
                    {
                        return 'email@example.com';
                    }
                };
            }
        };

        // 1. Dispatch confirmation message
        $bus->dispatch(new PurchaseConfirmationNotification($order));

        // 2. Display confirmation to user

        return $this->render('stock/example.html.twig');
    }
}
