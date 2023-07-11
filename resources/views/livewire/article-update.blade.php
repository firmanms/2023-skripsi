@extends('../layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="fs-5 fw-bold mb-1">{{ __('Edit') }}</h2>
                            <form action="{{ route('artikels.update',$artikel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <div class="row">
                                <div class="col-12 col-xl-8">
                                    <div class="col-md-12 mb-3">
                                        <div>
                                            <label for="first_name">Title</label>
                                            <input type="hidden" name="user_id" class="form-control input-sm @error ('user_id') is-invalid @enderror " placeholder="" value="{{ $artikel->user_id }}">
                                            <input type="text" name="judul" class="form-control input-sm @error ('judul') is-invalid @enderror " placeholder="" value="{{ $artikel->judul }}">
                                            {{-- <input type="date" class="form-control"  placeholder="2023-02-31" id="datepicker" name="dateofbirth" required> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <div>
                                            <label for="last_name">Description </label>
                                           {{-- <textarea class="descriptiona" id="description" name="description">{!! $artikel->description !!}</textarea> --}}
                                           <textarea name="description" id="summernote">{!! $artikel->description !!}</textarea>
                                           {{-- <div wire:ignore><textarea id="description">{{ $description }}</textarea></div> --}}
                                            </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="col-md-12 mb-3">
                                        <div>
                                            <label for="first_name">Date</label>
                                            <input type="date" name="publish" class="form-control input-sm @error ('publish') is-invalid @enderror " placeholder="" value="{{ $artikel->publish }}">
                                            {{-- <input type="date" class="form-control"  placeholder="2023-02-31" id="datepicker" name="dateofbirth" required> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <div>
                                            <label for="last_name">Categories</label>
                                            <select name="category_id" class="form-select @error ('category_id') is-invalid @enderror ">
                                                <option selected value="{{ $artikel->category_id }}">{{ $artikel->category->nama }}</option>
                                                <option >-Pilih-</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->nama }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <div>
                                            <label for="last_name">Published</label>
                                            <select name="status" class="form-select @error ('status') is-invalid @enderror ">
                                                <option selected value="{{ $artikel->status }}">
                                                    @if ($artikel->status=="warning")
                                                    Draft
                                                    @else
                                                    Published
                                                    @endif
                                                </option>
                                                <option >-Pilih-</option>
                                                <option value="warning">Draft</option>
                                                <option value="success">Published</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ">
                                        <div>
                                            <label for="last_name">Image</label>
                                            <input type="file" name="image" class="form-control input-sm @error ('image') is-invalid @enderror ">
                                        </div>
                                    </div>

                                    <div class="mt-1">
                                        <button class="btn btn-success mt-2 animate-up-2"  id="my-submit" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- summernote css/js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script type="text/javascript">
    $('#summernote').summernote({
        height: 400
    });
</script>
@endsection
<div>


</div>

