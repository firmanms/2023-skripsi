<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">Judul</label>
            <input type="text" class="form-control input-sm @error ('judul') is-invalid @enderror " placeholder="" wire:model="judul">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Sub Judul</label>
            <input type="text" class="form-control input-sm @error ('subjudul') is-invalid @enderror " placeholder="" wire:model="subjudul">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Gambar</label>
            <input type="file" class="form-control input-sm @error ('gambar') is-invalid @enderror " wire:model="gambar">
            <font color="red">*max 2Mb</font>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button wire:click="update()" class="btn btn-primary">Ubah</button>
        </div> 
</div>
