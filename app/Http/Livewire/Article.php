<?php

namespace App\Http\Livewire;

use App\Models\Kategori;
use App\Models\M_article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class article extends Component
{
    use WithFileUploads;
    public $user_id;
    public $judul;
    public $slug;
    public $description;
    public $status;
    public $category_id;
    public $image;
    public $oldgambar;
    public $publish;
    public $search;
    public $sortColumnName='publish';
    public $sortDirection='desc';
    public $updateMode = false;
    public $createMode = true;
        use WithPagination;
        protected $paginationTheme='bootstrap';
        protected $queryString = ['search'];
        protected $listeners = ['remove'];

    public function render()
    {
            return view('livewire.article',[
                'articles' => M_article::where('judul','like','%'.$this->search.'%')->orderBy($this->sortColumnName,$this->sortDirection)->paginate(10),
                'categories'=> Kategori::get()
            ]);
    }
    private function resetInput()
    {

        $this->judul = null;
        $this->description = null;
        $this->publish = null;
        $this->status = null;
        $this->category_id = null;
        $this->image = null;
    }
    public function mount()
    {
        $this->user_id = Auth::user()->id;

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
    //generate slug
    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }
    //crud
    //add
    public function add()
    {
        return view('livewire.article-create',[
            'categories'=> Kategori::get()
        ]);
    }
    public function store()
    {
        $this->validate([
            'user_id' => '',
            'judul' => 'required|string',
            'description' => 'required',
            'publish' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);

        $store=M_article::create([
            'user_id' => $this->user_id,
            'judul' => $this->judul,
            'slug' => Str::slug($this->judul),
            'description' => $this->description,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'image' => $this->image->store('article','public'),
            'publish' => $this->publish,
        ]);
        if($store){
            $this->dispatchBrowserEvent('articleStore');
            $this->alertSuccess();
            $this->resetInput();

            session()->flash('success','Article Berhasil Ditambahkan');

        }

    }

    public function edit($id)
    {
        $this->post = M_article::findOrFail($id);
        $record = M_article::findOrFail($id);
        $this->selected_id = $id;
        $this->judul = $record->judul;
        $this->description = $record->description;
        $this->status = $record->status;
        $this->category_id = $record->category_id;
        $this->publish = $record->publish;
        // $this->image = $record->image;
        $this->oldgambar = $record->image;
        $this->createMode= false;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'judul' => 'required',
            'description' => 'required',
            'publish' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);
        // $gambara = $this->post->gambar;
        if ($this->image) {
            $gambara = $this->image->store('article','public');
        }else{
            $gambara =  $this->oldgambar;
        }
        // dd($gambara);
        // $gambar = $this->post->gambar;
        // if ($this->gambar) {
        //     $gambar = $this->gambar->store('banner','public');
        // }
        if ($this->selected_id) {
            $record = M_article::find($this->selected_id);
            $record->update([
            'judul' => $this->judul,
            'description' => $this->description,
            'status'=> $this->status,
            'category_id'=> $this->category_id,
            'image' => $gambara,
            'publish'=> $this->publish
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy(M_article $id)
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
