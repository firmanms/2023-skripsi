<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="mb-3">
            {{-- <label for="parent" class="form-label">Parent ID</label> --}}
            <input type="text" class="form-control input-sm @error ('selected_id') is-invalid @enderror " placeholder="" wire:model="selected_id">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Pertanyaan</label>
            <input readonly type="text" class="form-control input-sm @error ('value') is-invalid @enderror " placeholder="" wire:model="value">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Jawaban</label>
            <input type="text" class="form-control input-sm @error ('answer') is-invalid @enderror " placeholder="" wire:model="answer">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button wire:click="upanswer()" class="btn btn-primary">Tambah</button>
        </div>
</div>
