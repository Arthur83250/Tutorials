<?php

namespace App\GuestBook;

require_once 'Message.php';

class GuestBook{

    private $file;
    
    public function __construct(string $file)
    {
        $directory = dirname($file);
        if (!is_dir($directory)){
            mkdir($directory, 0777, true);
        }
        if (file_exists($file)){
            touch($file);
        }
        $this->file = $file;
    }

    public function addMessage(Message $message)
    {
        file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);
    }

    public function getMessages()
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        $message = [];
        foreach ($lines as $line){
           $messages[] = Message::fromJSON($line);
        }
        return array_reverse($messages);
    }
}