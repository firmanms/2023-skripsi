<?php

namespace App\Http\Livewire;

use App\Models\Dokumen;
use Livewire\Component;
use Livewire\WithFileUploads;

class DokumenTable extends Component
{
    use WithFileUploads;
    public $user_id, $judul, $filenya;
  
   
    public function submit()
    {
        $data = $this->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'filenya' => 'required',
        ]);
  
        $filename= $this->filenya->store('dokumens', 'public');
        $data['file_name'] = $filename;
  
        Dokumen::create($data);
  
        session()->flash('message', 'File uploaded.');
    }
    public function render()
    {
        return view('livewire.dokumen-table');
    }
}
