<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\ChatMessage;

class Chat extends Component
{
    public $textValue = "";
    public $chatLog = [];

    public function getListeners()
    {
        return [
            "echo-private:chat-channel,ChatMessage" => 'notifyNewMessage'
        ];
    }

    public function notifyNewMessage($x)
    {
        array_push($this->chatLog, $x['chat']);
    }

    public function send()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        if (trim(strip_tags($this->textValue)) == "") {
            return;
        }

        $newMessage = [
            'selfMessage' => true,
            'username' => auth()->user()->username,
            'textValue' => strip_tags($this->textValue),
            'avatar' => auth()->user()->avatar,
        ];

        array_push($this->chatLog, $newMessage);

        broadcast(new ChatMessage(
            array_merge(
                $newMessage,
                ['selfMessage' => false]
            )
        ))->toOthers();

        $this->textValue = "";
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
