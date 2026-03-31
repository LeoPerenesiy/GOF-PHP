<?php

namespace FactoryMethod;

interface Document
{
    public function render(): string;
}

class PdfDocument implements Document
{
    public function render(): string
    {
        return "Rendering PDF";
    }
}

class WordDocument implements Document
{
    public function render(): string
    {
        return "Rendering Word";
    }
}

abstract class DocumentApp
{
    // Фабричный метод
    abstract protected function createDocument(): Document;

    public function open(): string
    {
        $doc = $this->createDocument();
        return $doc->render();
    }
}

class PdfApp extends DocumentApp
{
    protected function createDocument(): Document
    {
        return new PdfDocument();
    }
}

class WordApp extends DocumentApp
{
    protected function createDocument(): Document
    {
        return new WordDocument();
    }
}

$app = new PdfApp();
echo $app->open();

class FactoryMethod
{

}