<?php

namespace App\Http\Livewire;

use App\Models\M_faq;
use Livewire\WithPagination;
use Livewire\Component;

class Faq extends Component
{
    public $parent_id;
    public $value;
    public $answer;
    public $search;
    public $sortColumnName='id';
    public $sortDirection='asc';
    public $updateMode = false;
    public $answerMode = false;
        use WithPagination;
        protected $paginationTheme='bootstrap';
        protected $queryString = ['search'];
        protected $listeners = ['remove'];

    public function render()
    {
            return view('livewire.faq',[
                'faqs' => M_faq::with(['child'])->whereNull('parent_id')->where('value','like','%'.$this->search.'%')->orderBy($this->sortColumnName,$this->sortDirection)->paginate(10)
            ]);
    }
    private function resetInput()
    {

        $this->value = null;

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
            'parent_id' => '',
            'value' => 'required'

        ]);

        M_faq::create([
            'parent_id' => $this->parent_id,
            'value' => $this->value
        ]);
        $this->alertSuccess();
        $this->resetInput();

        session()->flash('success','Kegiatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $record = M_faq::findOrFail($id);
        $this->selected_id = $id;
        $this->parent_id = $record->parent_id;
        $this->value = $record->value;
        $this->updateMode = true;
    }

    public function addanswer($id)
    {
        $record = M_faq::findOrFail($id);
        $this->selected_id = $id;
        $this->parent_id = $id;
        $this->value = $record->value;
        $this->answerMode = true;
    }

    public function upanswer()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'parent_id' => '',
            'answer' => 'required'
        ]);
        M_faq::create([
            'parent_id' => $this->selected_id,
            'value' => $this->answer
        ]);
        $this->alertSuccess();
        $this->resetInput();

        session()->flash('success','Kegiatan Berhasil Ditambahkan');
        $this->answerMode = false;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'parent_id' => '',
            'value' => 'required'
        ]);
        if ($this->selected_id) {
            $record = M_faq::find($this->selected_id);
            $record->update([
                'parent_id' => $this->parent_id,
                'value' => $this->value
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy(M_faq $id)
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
