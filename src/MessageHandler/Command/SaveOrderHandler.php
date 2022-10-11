<?php

namespace App\MessageHandler\Command;

use App\Message\Command\SaveOrder;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SaveOrderHandler implements MessageHandlerInterface
{
    public function __invoke(SaveOrder $saveOrder)
    {

        // Save and order to the dadabase

        $orderId = 123;

        echo 'Order eing saved' .PHP_EOL;

//        Dispatch an event message
    }
}
