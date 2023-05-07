@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            {{-- <h2 class="mb-4 h5">{{ __('Users') }}</h2> --}}
            <div class="card-header border-bottom d-flex align-items-center justify-content-between"><h2 class="fs-5 fw-bold mb-0">Lihat Akun</h2><a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">Kembali</a></div>

            {{-- <p class="text-info mb-0">Sample table page</p> --}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>NIK:</strong>
                        {{ $user->nik }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date Of Birth:</strong>
                        {{ $user->dateofbirth }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telephone Number/Whatsapp:</strong>
                        {{ $user->phoneno }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Reg ID:</strong>
                        {{ $user->code }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Roles:</strong>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                {{ $v }}
                            @endforeach
                        @endif
                    </div>
                </div>

        </div>


        <h3><b>DOCUMENTS:</b></h3>
        <?php
        $documents=App\Models\Dokumen::where('user_id',$user->id)->get();
        ?>
        <table class="table table-hover">
                <thead>
                    <tr>

                        <th class="border-gray-200">{{ __('Title') }}</th>
                        <th class="border-gray-200">{{ __('File') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $document)
                        <tr>

                            <td><span class="fw-normal">{{ $document->judul }}</span></td>
                            <td><span class="fw-normal"><a href="{{ url('images/' . $document->image) }}" class="btn btn-success">Download</a></span></td>


                        </tr>
                    @endforeach
                </tbody>
            </table>


    </div>
@endsection
