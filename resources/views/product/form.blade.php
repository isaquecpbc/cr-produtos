@extends('templates.srtdash.template')

@section('content')

    @if(isset($errors) && count($errors) > 0)

    <div class="alert alert-danger">
    	@foreach( $errors->all() as $error )
    	<p>{{$error}}</p>
    	@endforeach
    </div>

    @endif

    @if(isset($product))
        {!! Form::open(['route' => ['products.update', $product->id], 'class' => 'form', 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'products.store', 'class' => 'form', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
    @endif

	<div class='row justify-content-center mt-3'>
        <div class="col-md-12 mb-3"><div class="form-group">
            {!! Form::text('name', $product->name ?? null, ['class' => 'form-control', 'placeholder' => 'Nome do produto']) !!}</div></div>
        <div class="col-md-12 mb-3"><div class="form-group">
            {!! Form::textarea('description', $product->description ?? null, ['class' => 'form-control', 'placeholder' => 'Descrição']) !!}</div></div>
    	<div class="col-md-12 mb-3"><div class="input-group">
            <span class="input-group-text" id="basic-addon-price">R$</span>
            {!! Form::text('price', $product->price ?? null, ['class' => 'form-control', 'placeholder' => 'Preço', 'aria-label' => 'Preço', 'aria-describedby' => 'basic-addon-price']) !!}</div></div>
        <div class="col-md-12">{!! Form::submit('Salvar',['class' => 'btn btn-primary pull-right']) !!}</div>
    </div>
    {!! Form::close() !!}

@endsection