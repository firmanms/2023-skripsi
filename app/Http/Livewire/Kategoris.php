<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kategori;


class Kategoris extends Component
{
    public $nama;
    public $status;
    public $search; 
    public $sortColumnName='id';
    public $sortDirection='asc';
    public $updateMode = false;
        use WithPagination;
        protected $paginationTheme='bootstrap';
        protected $queryString = ['search'];
        protected $listeners = ['remove'];
       
    public function render()
    {      
            return view('livewire.kategoris',[
                'kategoris' => Kategori::where('nama','like','%'.$this->search.'%')->orderBy($this->sortColumnName,$this->sortDirection)->paginate(10) 
            ]);
    }
    private function resetInput()
    {

        $this->nama = null;
        $this->status = null;
    }
    public function mount()
    {
        
    }

    public function sortBy($columnName)
    {
        if($this->sortColumnName===$columnName){
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'desc';
        }
        
        $this->sortColumnName=$columnName; 
    }

    public function swapSortDirection()
    {
        return $this ->sortDirection === 'desc' ? 'asc' : 'desc';
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    //notif
    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Berhasil Ditambahkan', 
                // 'text' => 'It will list on users table soon.'
            ]);
    }
    public function alertWarning()
    {
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Berhasil Diubah', 
                // 'text' => 'It will list on users table soon.'
            ]);
    }
    // public function alertConfirm()
    // {
    //     $this->dispatchBrowserEvent('swal:confirm', [
    //             'type' => 'warning',  
    //             'message' => 'Are you sure?', 
    //             'text' => 'If deleted, you will not be able to recover this imaginary file!'
    //         ]);
    // }
    public function remove()
    {
        $this->item->delete();
        /* Write Delete Logic */
        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Berhasil Dihapus', 
                // 'text' => 'It will not list on users table soon.'
            ]);
    }
    //crud
    public function store()
    {
        $this->validate([
            'nama' => 'required|string',
            'status' => 'required'
        ]);

        Kategori::create([
            'nama' => $this->nama,
            'status' => $this->status
        ]);
        $this->alertSuccess();
        $this->resetInput();

        session()->flash('success','Kegiatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $record = Kategori::findOrFail($id);
        $this->selected_id = $id;
        $this->nama = $record->nama;
        $this->status = $record->status;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'nama' => 'required',
            'status' => 'required'
        ]);
        if ($this->selected_id) {
            $record = Kategori::find($this->selected_id);
            $record->update([
                'nama' => $this->nama,
                'status' => $this->status
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy(Kategori $id)
    {
        $this->item=$id;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',  
            'message' => 'Anda  Yakin?', 
            'text' => 'Jika dihapus, data tidak bisa dikembalikan!'
        ]);
        // if ($id) {
        //     $record = Kategori::where('id', $id);
        //     $record->delete();
        // }
    }
}
