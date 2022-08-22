<?php

namespace App\Http\Livewire\Orders;

use App\Models\Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Attachments extends Component
{
    use WithFileUploads;

    public $order;

    public $attachment;

    public $attachmentToDelete = null;
    public $deleteModalVisible = false;

    public function upload(){
        $this->validate([
            'attachment' => 'file|max:2048'
        ], [
            'attachment.file' => "Nije odabran fajl.",
            'attachment.max' => "Veličina fajla je veća od 2MB."
        ]);

        $name = explode('.', $this->attachment->getClientOriginalName());
        array_pop($name);
        $path = implode("_", $name) . '_' . $this->order->id . '_' . now()->timestamp . '.' . $this->attachment->getClientOriginalExtension();

        try {
            DB::beginTransaction();
            Storage::disk('public_folder')->putFileAs('files', $this->attachment, $path);
            $this->order->attachments()->create(['path' => $path]);
            DB::commit();
        } catch (Throwable $e){
            DB::rollBack();
            Storage::disk('public_folder')->delete('files/' . $path);
            $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
            if(env('APP_ENV') == 'local'){
                dd($e->getMessage());
            }
        }
        

        $this->attachments = $this->fetch();
    }

    public function showDeleteModal(Attachment $attachment){
        $this->attachmentToDelete = $attachment;
        $this->deleteModalVisible = true;
    }

    public function cancelDelete(){
        $this->deleteModalVisible = false;
        $this->attachmentToDelete = null;
    }

    public function deleteAttachment(){
        if($this->attachmentToDelete != null){
            try {
                DB::beginTransaction();
                $attachment = Attachment::find($this->attachmentToDelete["id"]);
                Storage::disk('public_folder')->delete('files/' . $attachment->path);
                $attachment->delete();
                DB::commit();
            } catch (Throwable $e){
                DB::rollBack();
                $this->dispatchBrowserEvent('flasherror', ['message' => 'Došlo je do greške!']);
                if(env('APP_ENV') == 'local'){
                    dd($e->getMessage());
                }
            } finally {
                $this->deleteModalVisible = false;
                $this->attachments = $this->fetch();
                $this->attachmentToDelete = null;
            }
        }
    }

    private function fetch(){
        return Attachment::where('order_id', $this->order->id)->get();
    }

    public function mount(){
        $this->attachments = $this->fetch();
    }

    public function render()
    {
        return view('livewire.orders.attachments');
    }
}
