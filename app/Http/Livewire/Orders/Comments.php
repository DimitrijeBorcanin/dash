<?php

namespace App\Http\Livewire\Orders;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    protected $listeners = ["deleteComment" => "showDeleteModal", "editComment"];

    public $order;
    public $comments;

    public $state = [
        "comment" => ''
    ];

    public $commentToDelete = null;
    public $deleteModalVisible = false;

    public function mount(){
        $this->fetchComments();
    }

    private function fetchComments(){
        $this->comments = $this->order->comments()->orderBy('created_at', 'desc')->get();
    }

    public function addComment(){
        if(empty($this->state["comment"])){
            return;
        }
        $this->order->comments()->create(["text" => $this->state["comment"], "user_id" => auth()->user()->id]);
        $this->state["comment"] = '';
        $this->fetchComments();
    }

    public function editComment(){
        $this->fetchComments();
    }

    public function showDeleteModal(Comment $comment){
        if(Auth::user()->cannot('update', $comment)){
            return;
        }
        $this->commentToDelete = $comment;
        $this->deleteModalVisible = true;
    }

    public function cancelDelete(){
        $this->deleteModalVisible = false;
        $this->commentToDelete = null;
    }

    public function deleteComment(){
        if(Auth::user()->cannot('update', $this->commentToDelete)){
            return;
        }
        if($this->commentToDelete != null){
            $comment = Comment::find($this->commentToDelete["id"]);
            $comment->delete();
            $this->deleteModalVisible = false;
            $this->fetchComments();
            $this->commentToDelete = null;
        }
    }

    public function render()
    {
        return view('livewire.orders.comments');
    }
}
