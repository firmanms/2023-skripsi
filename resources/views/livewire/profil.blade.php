<div>
    @if($updateMode)
    @include('livewire.profil-update')
@else
@can('configurasi-create')
    {{-- @include('livewire.profil-create') --}}
@endcan
@endif
<br>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-2">
                <img src="{{ url('storage/'.$profils->foto_kepala .'') }}" class="img-fluid rounded-start" alt="..." width="100%">
              </div>
              <div class="col-md-10">
                <div class="card-body">
                  <h5 class="card-title">{{ $profils->nama_kepala }}</h5>
                  <p class="card-text">Sambutan:<br>{!! $profils->sambutan !!}</p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-12">
                <div class="card-body">
                  <b>Nama Kantor:</b>
                  <p class="card-text">{!! $profils->nama_kantor !!}</p>
                  <b>Alamat Kantor:</b>
                  <p class="card-text">{!! $profils->alamat_kantor !!}</p>
                  <b>Url Map:</b>
                  <p class="card-text">{!! $profils->url_map !!}</p>
                  <iframe src="{!! $profils->url_map !!}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  <b>Telp Kantor:</b>
                  <p class="card-text">{!! $profils->telp_kantor !!}</p>
                  <b>Hotline Whatsapp:</b>
                  <p class="card-text">{!! $profils->hotline_wa !!}</p>
                  <b>Email Kantor:</b>
                  <p class="card-text">{!! $profils->email_kantor !!}</p>
                  <b>Jam Layanan:</b>
                  <p class="card-text">{!! $profils->jam_layanan !!}</p>
                  <b>Selayang Pandang:</b>
                  <p class="card-text">{!! $profils->selayang_pandang !!}</p>
                  <b>Text Footer:</b>
                  <p class="card-text">{!! $profils->tupoksi !!}</p>
                  <b>Video Profil:</b>
                  <p class="card-text">{!! $profils->video_profil !!}</p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-12">
                <div class="card-body">
                  <b>Seo Description:</b>
                  <p class="card-text">{!! $profils->seo_desc !!}</p>
                  <b>Seo Keywords:</b>
                  <p class="card-text">{!! $profils->seo_keywords !!}</p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-12">
                <div class="card-body">
                  <b>Facebook:</b>
                  <p class="card-text">{!! $profils->fb !!}</p>
                  <b>Instagram:</b>
                  <p class="card-text">{!! $profils->ig !!}</p>
                  <b>Twitter:</b>
                  <p class="card-text">{!! $profils->tw !!}</p>
                  <b>ID Channel Youtube:</b>
                  <p class="card-text">{!! $profils->channel_yt !!}</p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <div class="card-body">
                  <b>Logo:</b>
                  <p class="card-text"> <img src="{{ url('storage/'.$profils->logo .'') }}" width="100%"></p>
                  <b>Favicon:</b>
                  <p class="card-text"> <img src="{{ url('storage/'.$profils->favicon .'') }}" width="100%"></p>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<table width="100%">
    <tr><td align="right">
        @can('configurasi-edit')
        <button wire:click="edit({{ $profils->id }})" class="btn btn-warning btn-sm">Ubah</button>
        @endcan
    </td></tr>
</table>
</div>

