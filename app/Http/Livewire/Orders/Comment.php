<?php

namespace App\Http\Livewire\Orders;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $comment;
    public $commentId;
    public $originalComment; 
    public $user; 
    public $date;

    public $state = [
        "text" => ''
    ];
    public $isEdit = false;

    public function mount($comment){
        $this->comment = $comment;
        $this->commentId = $comment["id"];
        $this->originalComment = $comment["text"];
        $this->state["text"] = $comment["text"];
        $this->user = $comment["user"]["name"];
        $this->date = $comment["date"];
    }

    public function showEdit(){
        $this->isEdit = true;
    }

    public function cancelEdit(){
        $this->state["text"] = $this->originalComment;
        $this->isEdit = false;
    }

    public function saveEdit(){
        if(Auth::user()->cannot('update', $this->comment)){
            return;
        }
        $this->comment->text = $this->state["text"];
        $this->comment->save();
        $this->isEdit = false;
        $this->emit('editComment');
    }

    public function deleteComment(){
        if(Auth::user()->cannot('update', $this->comment)){
            return;
        }
        $this->emit('deleteComment', $this->comment);
    }

    public function render()
    {
        return view('livewire.orders.comment');
    }
}
