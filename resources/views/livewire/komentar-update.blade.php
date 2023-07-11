<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">Komentar</label>
            <input type="text" class="form-control input-sm @error ('komentar') is-invalid @enderror " placeholder="" wire:model="komentar">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button wire:click="update()" class="btn btn-primary">Ubah</button>
        </div>
</div>
