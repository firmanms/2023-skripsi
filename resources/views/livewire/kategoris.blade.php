<div>
    @if($updateMode)
    @include('livewire.kategoris-update')
@else
    @include('livewire.kategoris-create')
@endif
<br>
<div class="table-responsive">
<input type="text"  class="form-control" placeholder="Cari" wire:model="search" />
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kategoris as $index => $kategori)
        <tr>
            <td>
                {{ $kategoris->firstItem() + $index }}
            </td>
            <td>
                {{ $kategori->nama }}
            </td>
            <td>
                {{ $kategori->status }}
            </td>
            @can('kategori-create')
            <td>
                <button wire:click="edit({{ $kategori->id }})" class="btn btn-warning btn-sm">Ubah</button>
                <button wire:click="destroy({{ $kategori->id }})" class="btn btn-danger btn-sm">Hapus</button>
                {{-- |
                <a  wire:click="destroy({{$kategori->id}})"><i class="fa fa-trash mr-2 text-danger"></i></a>
                 <button wire:click="edit({{$kategori->id}})" class="btn btn-sm btn-warning py-0"><svg class="w-6 h-6" width="15px" height="15px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button> |
                <button wire:click="destroy({{$kategori->id}})" class="btn btn-sm btn-danger py-0"><svg class="w-6 h-6" width="15px" height="15px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button> --}}
            </td>
            @endcan

        </tr>
        @endforeach
    </table>
        </tbody>
    </table>
</div>
    {{ $kategoris->links() }}



</div>
