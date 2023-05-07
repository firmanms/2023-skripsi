
<table class="table table-hover" width="100%" border='1'>
                <thead>
                    <tr>
                        <th class="border-gray-200">{{ __('No') }}</th>
                        <th class="border-gray-200">{{ __('Reg ID') }}</th>
                        <th class="border-gray-200">{{ __('Name') }}</th>
                        <th class="border-gray-200">{{ __('Family Name') }}</th>
                        <th class="border-gray-200">{{ __('Affiliation') }}</th>
                        <th class="border-gray-200">{{ __('Category') }}</th>
                        <th class="border-gray-200">{{ __('Presenter') }}</th>
                        <th class="border-gray-200">{{ __('Package') }}</th>
                        <th class="border-gray-200">{{ __('Whatsapp Number') }}</th>
                        <th class="border-gray-200">{{ __('Email') }}</th>
                        <!--<th class="border-gray-200">Roles</th>-->
                        <!--<th class="border-gray-200">Aksi</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    ?>
                    @foreach ($users as $user)
                        <tr>
                            <td><span class="fw-normal">{{ ++$i }}</span></td>
                            <td><span class="fw-normal">{{ $user->code }}</span></td>
                            <td><span class="fw-normal">{{ $user->name }}</span></td>
                            <td><span class="fw-normal">{{ $user->familyname }}</span></td>
                            <td><span class="fw-normal">{{ $user->affiliation }}</span></td>
                            <td><span class="fw-normal">{{ $user->category }}</span></td>
                            <?php
                                                    $kondisi= $user->presenter;
                                                    if($kondisi=='true'){
                                                        $presenterya="Yes";
                                                    }else{
                                                        $presenterya="No";
                                                    }
                                                    ?>
                            <td><span class="fw-normal"> {{ $presenterya }}</span></td>
                            
                            <td><span class="fw-normal">@php $pakets = $user->paket ? json_decode($user->paket, true) : []; @endphp
                    @foreach($pakets as $paket)
                        {{$paket}}<br>
                    @endforeach</span></td>
                    <td><span class="fw-normal">{{ $user->nowa }}</span>
                            <td><span class="fw-normal">{{ $user->email }}</span>
                            
                            </td>
                            <!--<td>-->
                            <!--    @if(!empty($user->getRoleNames()))-->
                            <!--      @foreach($user->getRoleNames() as $v)-->
                            <!--         {{ $v }}-->
                            <!--      @endforeach-->
                            <!--    @endif-->
                            <!--  </td>-->
                            <!--  <td>-->
                            <!--     <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Lihat</a>-->
                            <!--     @can('menu-approve')-->
                            <!--     <a class="btn btn-success" href="{{ route('users.approve',$user->id) }}">Approve</a>-->
                            <!--     @endcan-->
                            <!--     @can('menu-ubah')-->
                            <!--     <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Ubah</a>-->
                            <!--     @endcan-->
                                 
                            <!--      {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}-->
                            <!--          {!! Form::submit('Hapus', ['class' => 'btn btn-danger'],['onclick' => 'return confirm(\'Are you sure?\')']) !!}-->
                            <!--      {!! Form::close() !!}-->
                            <!--  </td>-->
                        </tr>
                    @endforeach
                </tbody>
            </table>