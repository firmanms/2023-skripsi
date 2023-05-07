@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            {{-- <h2 class="mb-4 h5">{{ __('Users') }}</h2> --}}
            <div class="card-header border-bottom d-flex align-items-center justify-content-between"><h2 class="fs-5 fw-bold mb-0">Ubah Akun</h2><a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">Kembali</a></div>

            {{-- <p class="text-info mb-0">Sample table page</p> --}}
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            {!! Form::model($user, ['method' => 'PATCH','route' => ['users.updateapp', $user->id]]) !!}
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <?php
                                                    $kondisi=$user->statusnya;
                                                    if($kondisi=='warning'){
                                                        $statusnya='Pending';
                                                    }else if($kondisi=='success'){
                                                        $statusnya='Approve';
                                                    }else if($kondisi=='danger'){
                                                        $statusnya='Pending';
                                                    }else if($kondisi=='info'){
                                                        $statusnya='Panitia';
                                                    }
                                                    ?>
                        <strong>Status:</strong>
                        <select class="form-select" id="position-option" name="statusnya" required>
                                    <option value="{{old('statusnya',$user->statusnya)}}" selected>{{old('statusnya',$statusnya)}}</option>
                                    <option value="warning">Pending</option>
                                    <option value="success">Approve</option>
                                    <option value="danger">Reject</option>
                                    
                                    
                                    </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection
