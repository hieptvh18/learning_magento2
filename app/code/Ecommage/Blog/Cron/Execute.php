<?php

namespace Ecommage\Blog\Cron;
use Psr\Log\LoggerInterface;

class Execute {

    protected $logger;


    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    public function execute(){
        // log to system.log
        $this->logger->info('Cron job test is worked! + '. uniqid());
    }
}
