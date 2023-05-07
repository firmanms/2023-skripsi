<?php

namespace App\Http\Livewire;

use App\Models\M_booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Bookingadmin extends Component
{
    use WithFileUploads;
    public $date_booking;
    public $coderandom;
    public $user_id;
    public $jenis;
    public $filenya;
    public $status;
    public $search;
    public $sortColumnName='id';
    public $sortDirection='asc';
    public $updateMode = false;
    public $checkinMode = false;
    public $uploadMode = false;
        use WithPagination;
        protected $paginationTheme='bootstrap';
        protected $queryString = ['search'];
        protected $listeners = ['remove'];

    public function render()
    {
            return view('livewire.bookingadmin',[
                'bookings' => M_booking::where('date_booking','like','%'.$this->search.'%')->orwhere('jenis','like','%'.$this->search.'%')->orwhere('coderandom','like','%'.$this->search.'%')->orderBy('date_booking','desc')->paginate(10)
            ]);
    }
    private function resetInput()
    {

        $this->date_booking = null;
        $this->jenis = null;

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
    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (M_booking::where("coderandom", "=", $code)->first());
        return $code;
    }
    public function store()
    {
        $this->validate([
            'date_booking' => 'required',
            'jenis' => 'required',
        ]);

        M_booking::create([
            'date_booking' => $this->date_booking,
            'coderandom' => $this->generateUniqueCode(),
            'user_id' => Auth::user()->id,
            'jenis' => $this->jenis,
            'image' => '-',
            'status' => 'pending',

        ]);
        $this->alertSuccess();
        $this->resetInput();

        session()->flash('success','link Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $this->post = M_booking::findOrFail($id);
        $record = M_booking::findOrFail($id);
        $this->selected_id = $id;
        $this->date_booking = $record->date_booking;
        $this->jenis = $record->jenis;
        $this->updateMode = true;
    }

    public function getcheckin($id)
    {
        $this->post = M_booking::findOrFail($id);
        $record = M_booking::findOrFail($id);
        $this->selected_id = $id;
        $this->date_booking = $record->date_booking;
        $this->jenis = $record->jenis;
        $this->checkinMode = true;
    }

    public function getuploads($id)
    {
        $this->post = M_booking::findOrFail($id);
        $record = M_booking::findOrFail($id);
        $this->selected_id = $id;
        $this->date_booking = $record->date_booking;
        $this->jenis = $record->jenis;
        $this->uploadMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'date_booking' => 'required',
            'jenis' => 'required',
        ]);

        if ($this->selected_id) {
            $record = M_booking::find($this->selected_id);
            $record->update([
            'date_booking' => $this->date_booking,
            'jenis' => $this->jenis,
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function canceled()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
        ]);

        if ($this->selected_id) {
            $record = M_booking::find($this->selected_id);
            $record->update([
            'status' => 'cancel',
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function checkin()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
        ]);

        if ($this->selected_id) {
            $record = M_booking::find($this->selected_id);
            $record->update([
            'status' => 'checkin',
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->checkinMode = false;
        }
    }

    public function uploads()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'filenya' => 'required|mimes:pdf|max:50000',
        ]);

        $image = $this->post->filenya;
        if ($this->filenya) {
            $image = $this->filenya->store('pdfnya','public');
        }

        if ($this->selected_id) {
            $record = M_booking::find($this->selected_id);
            $record->update([
            'status' => 'success',
            'image' => $image,
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->uploadMode = false;
        }
    }

    public function destroy(M_booking $id)
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
