@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            {{-- <h2 class="mb-4 h5">{{ __('Users') }}</h2> --}}
            <div class="card-header border-bottom d-flex align-items-center justify-content-between"><h2 class="fs-5 fw-bold mb-0">{{ __('Users') }}</h2>
            <!--<a href="{{ route('users.create') }}" class="btn btn-sm btn-success">Tambah Akun</a>-->
            </div>

            {{-- <p class="text-info mb-0">Sample table page</p> --}}
            <form class="form" method="get" action="{{ route('search') }}">
                <div class="form-group w-100 mb-3">
                    <label for="search" class="d-block mr-2">Pencarian</label>
                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan keyword">
                    <button type="submit" class="btn btn-primary mb-1">Cari</button>
                </div>
            </form>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="border-gray-200">{{ __('No') }}</th>
                        <th class="border-gray-200">{{ __('Reg ID') }}</th>
                        <th class="border-gray-200">{{ __('Name') }}</th>
                        <th class="border-gray-200">{{ __('Email') }}</th>
                        <th class="border-gray-200">Roles</th>
                        <th class="border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><span class="fw-normal">{{ ++$i }}</span></td>
                            <td><span class="fw-normal">{{ $user->code }}</span></td>
                            <td><span class="fw-normal">{{ $user->name }}</span></td>
                            <td><span class="fw-normal">{{ $user->email }}</span><br>
                            <?php
                                                    $kondisi=$user->statusnya;
                                                    if($kondisi=='warning'){
                                                        $statusnya='Pending';
                                                        $urlnya='#';
                                                    }else if($kondisi=='success'){
                                                        $statusnya='Approve';
                                                        // $urlnya='#' ;
                                                        $urlnya= route('sendmail',$user->id) ;
                                                    }else if($kondisi=='danger'){
                                                        $statusnya='Pending';
                                                        $urlnya='#';
                                                    }else if($kondisi=='info'){
                                                        $statusnya='Panitia';
                                                        // $urlnya='#';
                                                        $urlnya= route('sendmail',$user->id) ;
                                                    }
                                                    ?>
                                <span class="fw-normal"><a href="{{ $urlnya }}" class="btn btn-{{ $kondisi }}">{{ $statusnya }}</a></span>
                            </td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                  @foreach($user->getRoleNames() as $v)
                                     {{ $v }}
                                  @endforeach
                                @endif
                              </td>
                              <td>
                                 <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                 @can('menu-approve')
                                 {{-- <a class="btn btn-success" href="{{ route('users.approve',$user->id) }}">Approve</a> --}}
                                 @endcan
                                 @can('user-edit')
                                 <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                 @endcan

                                  {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                      {!! Form::submit('Delete', ['class' => 'btn btn-danger'],['onclick' => 'return confirm(\'Are you sure?\')']) !!}
                                  {!! Form::close() !!}
                              </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {!! $users->render() !!} --}}
            <div
                class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
