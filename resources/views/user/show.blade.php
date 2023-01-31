@extends('templates.srtdash.template')

@push('styles')
    @include('templates.custom.show')
@endpush

@section('content')
    <div id="logoShow" class='row'>
    	<div class='col-md-1'>
          	<img class="rounded-circle me-3" src="https://ui-avatars.com/api/?name={{ $user->name }}&amp;background=9bc99d&amp;color=fff&amp;size=35" alt="{{ $user->name }}" height="40px" width="40px">
		</div>
    	<div class='col-md-10'>
			<h2>{{$user->name}}</h2>
		</div>
		<div class='col-md-1'>
			<ul class="d-flex justify-content-end mt-3">
                <li class="justify-content-center me-2">
                	<a href="{{route('users.edit', $user->id)}}" class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Editar dados" alt="Editar dados"><i class="fa fa-edit"></i></a>
                </li>
                <li class="justify-content-center">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'class' => 'justify-content-center', 'method' => 'DELETE']) !!}
                        <button type="submit" class="text-danger bnt-excluir" data-toggle="tooltip" data-placement="bottom" title="Excluir" alt="Excluir"><i class="ti-trash"></i></button>
                    {!! Form::close() !!}
                </li>
            </ul>
		</div>
		<div class='col-md-12'>
			<hr>
		</div>
    </div>

   	<div class='container py-4'>
        <div class='row justify-content-center'>
          <div class='col-md-8'>
            <div class='card'>
              <div class='card-header'>
                <h4 class='list-inline-item'>Dados de {{$user->name}}</h4>
              </div>
		      <div class='card-body p-2'>

		        <ul class='list-group list-group-flush' id="">
		            <div class='list-group-item list-group-item-action d-flex'>
		            	<p>{{$user->name}}</p>
		            </div>
		            <div class='list-group-item list-group-item-action d-flex'>
						<p>{{$user->email}}</p>
		            </div>
		        </ul>
		      </div>
            </div>
          </div>
        </div>
  	</div>

@endsection