<?php

namespace ChainOfResponsibility;

abstract class Handler
{
    protected ?Handler $next = null;

    public function setNext(Handler $handler): Handler
    {
        $this->next = $handler;
        return $handler;
    }

    public function handle(string $request): string
    {
        if ($this->next) {
            return $this->next->handle($request);
        }

        return "Никто не обработал запрос";
    }
}

class AuthHandler extends Handler
{
    public function handle(string $request): string
    {
        if ($request === 'auth') {
            return "Обработано: авторизация";
        }

        return parent::handle($request);
    }
}

class LogHandler extends Handler
{
    public function handle(string $request): string
    {
        if ($request === 'log') {
            return "Обработано: логирование";
        }

        return parent::handle($request);
    }
}

class DefaultHandler extends Handler
{
    public function handle(string $request): string
    {
        return "Fallback: обработал DefaultHandler";
    }
}