<?php

namespace Command;

class Editor
{
    public function deleteText()
    {
        echo "Text deleted\n";
    }
}

$editor = new Editor();
$editor->deleteText();

//--------------------------

interface Command
{
    public function execute();
    public function undo();
}

class Editor2
{
    public function deleteText()
    {
        echo "Text deleted\n";
    }
}

class Button
{
    private Command $command;

    public function __construct(Command $command) {
        $this->command = $command;
    }

    public function click()
    {
        $this->command->execute();
    }

    public function undoClick()
    {
        $this->command->undo();
    }
}

class DeleteTextCommand implements Command
{
    private Editor2 $editor;

    public function __construct(Editor2 $editor) {
        $this->editor = $editor;
    }

    public function execute()
    {
        $this->editor->deleteText();
    }

    public function undo()
    {
        echo "Text restored\n";
    }
}

$editor = new Editor();
$command = new DeleteTextCommand($editor);

$button = new Button($command);

$button->click();      // Text deleted
$button->undoClick();  // Text restored