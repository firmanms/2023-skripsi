<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="col-md-12 mb-3">
                <div>
                    <label for="first_name">Title</label>
                    <input type="text" class="form-control input-sm @error ('judul') is-invalid @enderror " placeholder="" wire:model="judul">
                    {{-- <input type="date" class="form-control"  placeholder="2023-02-31" id="datepicker" name="dateofbirth" required> --}}
                </div>
            </div>
            <div class="col-md-12 mb-3 ">
                <div>
                    <label for="last_name">Description  {{ $description }}</label>
                    <div wire:ignore><textarea wire:model="description" class="description"  name="description"></textarea></div>
                    {{-- <div wire:ignore><textarea id="description">{{ $description }}</textarea></div> --}}
                    </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="col-md-12 mb-3">
                <div>
                    <label for="first_name">Date</label>
                    <input type="date" class="form-control input-sm @error ('publish') is-invalid @enderror " placeholder="" wire:model="publish">
                    {{-- <input type="date" class="form-control"  placeholder="2023-02-31" id="datepicker" name="dateofbirth" required> --}}
                </div>
            </div>
            <div class="col-md-12 mb-3 ">
                <div>
                    <label for="last_name">Categories</label>
                    <select class="form-select @error ('category_id') is-invalid @enderror " wire:model="category_id">
                        <option selected>-Pilih-</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nama }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="col-md-12 mb-3 ">
                <div>
                    <label for="last_name">Published</label>
                    <select class="form-select @error ('status') is-invalid @enderror " wire:model="status">
                        <option value="">-Pilih-</option>
                        <option value="warning">Draft</option>
                        <option value="success">Published</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-3 ">
                <div>
                    <label for="last_name">Image</label>
                    <input type="file" class="form-control input-sm @error ('image') is-invalid @enderror " wire:model="image">
                </div>
            </div>

            <div class="mt-1">
                <button class="btn btn-success mt-2 animate-up-2"  id="my-submit" wire:click="update()">Update</button>
            </div>
        </div>
    </div>
    <script>
        tinymce.init({
  selector: 'textarea.description',
  //plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link code table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  forced_root_block: false,
    setup: function (editor) {
        editor.on('init change', function () {
            editor.save();
        });
        editor.on('change', function (e) {
        @this.set('description', editor.getContent());
        });
    },
});
</script>
</div>

