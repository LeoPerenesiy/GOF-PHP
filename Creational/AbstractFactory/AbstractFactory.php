<?php

if ('dev') {
    $logger = new EchoLogger();
    $queue = new NullQueue();
    $mailer = new FakeMailer();
} else {
    $logger = new FileLogger();
    $queue = new RabbitQueue();
    $mailer = new SmtpMailer();
}

interface AppFactory {
    public function logger(): Logger;
    public function queue(): Queue;
    public function mailer(): Mailer;
}

class ProdFactory implements AppFactory {

    public function logger(): Logger {
        return new FileLogger();
    }

    public function queue(): Queue {
        return new RabbitQueue();
    }

    public function mailer(): Mailer {
        return new SmtpMailer();
    }
}

class DevFactory implements AppFactory {

    public function logger(): Logger {
        return new EchoLogger();
    }

    public function queue(): Queue {
        return new NullQueue();
    }

    public function mailer(): Mailer {
        return new FakeMailer();
    }
}

class App
{
    private AppFactory $factory;

    public function __construct(AppFactory $factory) {
        $this->factory = $factory;
    }

    public function run(): void
    {
        $logger = $this->factory->logger();
        $queue = $this->factory->queue();
        $mailer = $this->factory->mailer();

        $logger->log("start");
        $mailer->send("hello");
    }
}