<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control input-sm @error ('nama') is-invalid @enderror " placeholder="" wire:model="nama">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Status</label>
            <input wire:model="status" type="radio" value="Aktif" >Aktif
            <input wire:model="status" type="radio" value="Tidak Aktif" >Tidak Aktif
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button wire:click="update()" class="btn btn-primary">Ubah</button>
        </div> 
</div>
