<?php

namespace App\Http\Livewire;

use App\Models\M_komentar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Komentar extends Component
{

    public $artikel_id;
    public $parent_id;
    public $user_id;
    public $komentar;
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
        $cari=$this->search;
        $iduser=Auth::user()->id;
        if(Auth::user()->hasRole('Admin')){

            return view('livewire.komentar',[
                'comments' => M_komentar::where('komentar','like','%'.$cari.'%')
                            ->orderBy('updated_at','desc')
                            ->paginate(10)

            ]);
        }else{
            return view('livewire.komentar',[
                'comments' => M_komentar::where('user_id',$iduser)->where('komentar','like','%'.$cari.'%')
                            ->orderBy('updated_at','desc')
                            ->paginate(10)

            ]);

        }

    }
    private function resetInput()
    {

        $this->komentar = null;

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

    }

    public function edit($id)
    {
        $record = M_komentar::findOrFail($id);
        $this->selected_id = $id;
        $this->komentar = $record->komentar;
        $this->updateMode = true;
    }


    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'komentar' => 'required',

        ]);

        if ($this->selected_id) {
            $record = M_komentar::find($this->selected_id);
            $record->update([
            'komentar' => $this->komentar,
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }


    public function destroy(M_komentar $id)
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
