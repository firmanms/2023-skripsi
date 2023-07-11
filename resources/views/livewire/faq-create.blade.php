<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="mb-3">
            {{-- <label for="parent" class="form-label">Parent ID</label> --}}
            <input type="hidden" class="form-control input-sm @error ('parent_id') is-invalid @enderror " placeholder="" wire:model="parent_id">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Value</label>
            <input type="text" class="form-control input-sm @error ('value') is-invalid @enderror " placeholder="" wire:model="value">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button wire:click="store()" class="btn btn-primary">Tambah</button>
        </div>
</div>
