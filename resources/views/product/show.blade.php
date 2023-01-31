@extends('templates.srtdash.template')

@push('styles')
    @include('templates.custom.show')
@endpush

@section('content')
   	<div class='container py-4'>
        <div class='row justify-content-center'>
          <div class='col-md-8'>
            <div class='card'>
              <div class='card-header'>
                <h4 class='list-inline-item'>Dados de {{$product->name}}</h4>
              </div>
		      <div class='card-body p-2'>

		        <ul class='list-group list-group-flush' id="">
		            <div class='list-group-item list-group-item-action d-flex'>
		            	<p>{{$product->name}}</p>
		            </div>
		            <div class='list-group-item list-group-item-action d-flex'>
						<p>{{$product->description}}</p>
		            </div>
		            <div class='list-group-item list-group-item-action d-flex'>
						<p>R$ {{$product->price}}</p>
		            </div>
		            <div class='list-group-item list-group-item-action d-flex'>
						<p>Criado por: <i>{{$product->user->name}}</i></p>
		            </div>
		       	@auth
		            <div class='list-group-item list-group-item-action d-flex'>
						<ul class="d-flex justify-content-end w-100">
			                <li class="justify-content-center me-2">
			                	<a href="{{route('products.edit', $product->id)}}" class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Editar dados" alt="Editar dados"><i class="fa fa-edit"></i></a>
			                </li>
			            @if(Auth::user()->admin)
			                <li class="justify-content-center">
			                    {!! Form::open(['route' => ['products.destroy', $product->id], 'class' => 'justify-content-center', 'method' => 'DELETE']) !!}
			                        <button type="submit" class="text-danger bnt-excluir" data-toggle="tooltip" data-placement="bottom" title="Excluir" alt="Excluir"><i class="ti-trash"></i></button>
			                    {!! Form::close() !!}
			                </li>
			            @endif
			            </ul>
		            </div>
		        @endauth
		        </ul>
		      </div>
            </div>
          </div>
        </div>
  	</div>

@endsection