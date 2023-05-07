<?php

namespace App\Http\Livewire;

use App\Models\M_banner;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class banner extends Component
{
    use WithFileUploads;
    public $judul;
    public $subjudul;
    public $gambar;
    public $oldgambar;
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
            return view('livewire.banner',[
                'banners' => M_banner::where('judul','like','%'.$this->search.'%')->orderBy($this->sortColumnName,$this->sortDirection)->paginate(10)
            ]);
    }
    private function resetInput()
    {

        $this->judul = null;
        $this->subjudul = null;
        $this->gambar = null;
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
            'judul' => 'required|string',
            'subjudul' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);

        M_banner::create([
            'judul' => $this->judul,
            'subjudul' => $this->subjudul,
            'gambar' => $this->gambar->store('banner','public'),
        ]);
        $this->alertSuccess();
        $this->resetInput();

        session()->flash('success','Kegiatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $this->post = M_banner::findOrFail($id);
        $record = M_banner::findOrFail($id);
        $this->selected_id = $id;
        $this->judul = $record->judul;
        $this->subjudul = $record->subjudul;
        $this->oldgambar = $record->gambar;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'judul' => 'required',
            'subjudul' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);
        // $gambara = $this->post->gambar;
        if ($this->gambar) {
            $gambara = $this->gambar->store('gambar','public');
        }else{
            $gambara =  $this->oldgambar;
        }
        // $gambar = $this->post->gambar;
        // if ($this->gambar) {
        //     $gambar = $this->gambar->store('banner','public');
        // }
        if ($this->selected_id) {
            $record = M_banner::find($this->selected_id);
            $record->update([
            'judul' => $this->judul,
            'subjudul' => $this->subjudul,
            'gambar' => $gambara
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy(M_banner $id)
    {
        $this->item=$id;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Anda  Yakin?',
            'text' => 'Jika dihapus, data tidak bisa dikembalikan!'
        ]);
        // if ($id) {
        //     $record = Api::where('id', $id);
        //     $record->delete();
        // }
    }
}
