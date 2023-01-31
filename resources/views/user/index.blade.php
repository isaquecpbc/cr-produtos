@extends('templates.srtdash.template')

@push('styles')
    @include('templates.srtdash.inc.datatablecss')
@endpush

@push('scripts')
    @include('templates.srtdash.inc.datatablejs')
@endpush

@section('content')
<div class="row">

    @if(isset($errors) && count($errors) > 0)

    <div class="col-md-12 mt-3">
        <div class="alert alert-danger w-100">
           @foreach( $errors->all() as $error )
            <p>{{$error}}</p>
            @endforeach
        </div>
    </div>

    @endif
    
    @if(session()->has('status'))

    <div class="col-md-12 mt-3">
        <div class="alert alert-success w-100">
            <p>{{session()->get('status')}}</p>
        </div>
    </div>
    @endif

    <!-- data table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="data-tables">
                    <table id="dataTable" class="table table-hover text-center" width="100%">
                        <thead class="text-capitalize bg-info">
                            <tr class="text-white">
                                <th class="text-start" 
                                    >ID</th>
                                <th class="text-start"
                                    >Nome</th>
                                <th class="text-start"
                                    >E-mail</th>
                                <th class="text-end"
                                    ></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                
                                <td scope="row" class="text-start"
                                    >{{$user->id}}</th>
                                <td class="text-start"
                                    >{{$user->name}}</td>
                                <td class="text-start"
                                    >{{$user->email}}</td>
                                <td class="text-end">
                                    <ul class="d-flex justify-content-end">
                                        <li class="me-3"><a href="{{route('users.show', $user->id)}}" class="text-secondary text-info" data-toggle="tooltip"  data-placement="bottom" title="Visualizar" alt="Visualizar"><i class="fa fa-eye"></i></a></li>
                                        <li class="me-3"><a href="{{route('users.edit', $user->id)}}" class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Editar" alt="Editar"><i class="fa fa-edit"></i></a></li>
                                        <li>
                                            {!! Form::open(['route' => ['users.destroy', $user->id], 'class' => '', 'method' => 'DELETE']) !!}
                                                <button type="submit" class="text-danger bnt-excluir" data-toggle="tooltip" data-placement="bottom" title="Excluir" alt="Excluir"><i class="ti-trash"></i></button>
                                            {!! Form::close() !!}
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->

</div>
@endsection