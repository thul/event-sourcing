<?php

namespace Bartdezwaan\EventSourcing\CommandHandling;

interface Gateway
{
    /**
     * Send a command.
     * 
     * @param object $command
     */
    public function send($command, Callback $callback = null);
}
