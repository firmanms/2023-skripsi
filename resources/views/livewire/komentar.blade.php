<div>
        @if($updateMode)
        @include('livewire.komentar-update')
    @else

    @endif
        <div class="table-responsive">
            <input type="text"  class="form-control" placeholder="Cari" wire:model="search" />
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">#</th>
                        <th class="border-0">Judul Artikel</th>
                        <th class="border-0">Komentar</th>
                        <th class="border-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $index => $comment)
                    <tr>
                        <td>{{ $comments->firstItem() + $index }}</td>
                        <td>
                            {{ $comment->posts->judul }}
                            <a href="{{ route('artikel.read',$comment->posts->slug) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16" id="IconChangeColor"> <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" id="mainIconPathAttribute" fill="green"></path> </svg>
                            </a></td>
                        <td>{{ $comment->komentar }}<br>
                        user:{{ $comment->users->name }}</td>
                        <td>
                            <button wire:click="edit({{ $comment->id }})" class="btn btn-warning btn-sm">Ubah</button>
                            <button wire:click="destroy({{ $comment->id }})" class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $comments->links() }}
        </div>




</div>
