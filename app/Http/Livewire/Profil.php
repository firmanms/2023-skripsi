<?php

namespace App\Http\Livewire;

use App\Models\M_profil;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Profil extends Component
{
    use WithFileUploads;
    public $nama_kepala;
    public $sambutan;
    public $selayang_pandang;
    public $tupoksi;
    public $video_profil;
    public $foto_kepala;
    public $oldfoto_kepala;
    public $nama_kantor;
    public $alamat_kantor;
    public $url_map;
    public $telp_kantor;
    public $hotline_wa;
    public $email_kantor;
    public $jam_layanan;
    public $seo_desc;
    public $seo_keywords;
    public $fb;
    public $ig;
    public $tw;
    public $channel_yt;
    public $logo;
    public $oldlogo;
    public $favicon;
    public $oldfavicon;
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
            return view('livewire.profil',[
                'profils' => M_profil::where('nama_kantor','like','%'.$this->search.'%')->orderBy($this->sortColumnName,$this->sortDirection)->first()
            ]);
    }
    private function resetInput()
    {

        $this->nama_kepala = null;
        $this->sambutan = null;
        $this->selayang_pandang = null;
        $this->tupoksi = null;
        $this->video_profil = null;
        $this->foto_kepala = null;
        $this->nama_kantor = null;
        $this->alamat_kantor = null;
        $this->url_map = null;
        $this->telp_kantor = null;
        $this->hotline_wa = null;
        $this->email_kantor = null;
        $this->jam_layanan = null;
        $this->seo_desc = null;
        $this->seo_keywords = null;
        $this->fb = null;
        $this->ig = null;
        $this->tw = null;
        $this->channel_yt = null;
        $this->logo = null;
        $this->favicon = null;
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
            'nama_kepala' => 'required|string',
            'sambutan' => 'required',
            'selayang_pandang' => 'required',
            'tupoksi' => 'required',
            'video_profil' => 'required',
            'foto_kepala' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'nama_kantor' => 'required',
            'alamat_kantor' => 'required',
            'url_map' => 'required',
            'telp_kantor' => 'required',
            'hotline_wa' => 'required',
            'email_kantor' => 'required',
            'jam_layanan' => 'required',
            'seo_desc' => 'required',
            'seo_keywords' => 'required',
            'fb' => 'required',
            'ig' => 'required',
            'tw' => 'required',
            'channel_yt' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'favicon' => 'image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        M_profil::create([
            'nama_kepala' => $this->nama_kepala,
            'sambutan' => $this->sambutan,
            'selayang_pandang' => $this->selayang_pandang,
            'tupoksi' => $this->tupoksi,
            'video_profil' => $this->video_profil,
            'foto_kepala' => $this->foto_kepala->store('profil','public'),
            'nama_kantor' => $this->nama_kantor,
            'alamat_kantor' => $this->alamat_kantor,
            'url_map' => $this->url_map,
            'telp_kantor' => $this->telp_kantor,
            'hotline_wa' => $this->hotline_wa,
            'email_kantor' => $this->email_kantor,
            'jam_layanan' => $this->jam_layanan,
            'seo_desc' => $this->seo_desc,
            'seo_keywords' => $this->seo_keywords,
            'fb' => $this->fb,
            'ig' => $this->ig,
            'tw' => $this->tw,
            'channel_yt' => $this->channel_yt,
            'logo' => $this->foto_kepala->store('logo','public'),
            'favicon' => $this->foto_kepala->store('favicon','public'),
        ]);
        $this->alertSuccess();
        $this->resetInput();

        session()->flash('success','Kegiatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $this->post = M_profil::findOrFail($id);
        $record = M_profil::findOrFail($id);
        $this->selected_id = $id;
        $this->nama_kepala = $record->nama_kepala;
        $this->sambutan = $record->sambutan;
        $this->selayang_pandang = $record->selayang_pandang;
        $this->tupoksi = $record->tupoksi;
        $this->video_profil = $record->video_profil;
        $this->oldfoto_kepala = $record->foto_kepala;
        $this->nama_kantor = $record->nama_kantor;
        $this->alamat_kantor = $record->alamat_kantor;
        $this->url_map = $record->url_map;
        $this->telp_kantor = $record->telp_kantor;
        $this->hotline_wa = $record->hotline_wa;
        $this->email_kantor = $record->email_kantor;
        $this->jam_layanan = $record->jam_layanan;
        $this->tupoksi = $record->tupoksi;
        $this->seo_desc = $record->seo_desc;
        $this->seo_keywords = $record->seo_keywords;
        $this->fb = $record->fb;
        $this->ig = $record->ig;
        $this->tw = $record->tw;
        $this->channel_yt = $record->channel_yt;
        $this->oldlogo = $record->logo;
        $this->oldfavicon = $record->favicon;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'nama_kepala' => 'required|string',
            'sambutan' => 'required',
            'selayang_pandang' => 'required',
            'tupoksi' => 'required',
            'video_profil' => 'required',

            'nama_kantor' => 'required',
            'alamat_kantor' => 'required',
            'url_map' => 'required',
            'telp_kantor' => 'required',
            'hotline_wa' => 'required',
            'email_kantor' => 'required|email',
            'jam_layanan' => 'required',
            'seo_desc' => 'required',
            'seo_keywords' => 'required',
            'fb' => 'required',
            'ig' => 'required',
            'tw' => 'required',
            'channel_yt' => 'required',

        ]);
        // $foto_kepalaa = $this->post->foto_kepala;
        if (!empty($this->foto_kepala)) {
            $foto_kepalaa = $this->foto_kepala->store('foto_kepala','public');
        }else{
            $foto_kepalaa =  $this->oldfoto_kepala;
        }
        // $logoo = $this->post->logo;
        if (!empty($this->logo)) {
            $logoo = $this->logo->store('logo','public');
        }else{
            $logoo =  $this->oldlogo;
        }
        // $faviconn = $this->post->favicon;
        if (!empty($this->favicon)) {
            $faviconn = $this->favicon->store('favicon','public');
        }else{
            $faviconn =  $this->oldfavicon;
        }
        if ($this->selected_id) {
            $record = M_profil::find($this->selected_id);
            $record->update([
            'nama_kepala' => $this->nama_kepala,
            'sambutan' => $this->sambutan,
            'selayang_pandang' => $this->selayang_pandang,
            'tupoksi' => $this->tupoksi,
            'video_profil' => $this->video_profil,
            'foto_kepala' => $foto_kepalaa,
            'nama_kantor' => $this->nama_kantor,
            'alamat_kantor' => $this->alamat_kantor,
            'url_map' => $this->url_map,
            'telp_kantor' => $this->telp_kantor,
            'hotline_wa' => $this->hotline_wa,
            'email_kantor' => $this->email_kantor,
            'jam_layanan' => $this->jam_layanan,
            'seo_desc' => $this->seo_desc,
            'seo_keywords' => $this->seo_keywords,
            'fb' => $this->fb,
            'ig' => $this->ig,
            'tw' => $this->tw,
            'channel_yt' => $this->channel_yt,
            'logo' => $logoo,
            'favicon' => $faviconn
            ]);
            $this->alertWarning();
            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy(M_profil $id)
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
