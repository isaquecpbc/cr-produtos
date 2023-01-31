@extends('templates.srtdash.template')

@section('content')

    @if(isset($errors) && count($errors) > 0)

    <div class="alert alert-danger">
    	@foreach( $errors->all() as $error )
    	<p>{{$error}}</p>
    	@endforeach
    </div>

    @endif

    @if(isset($user))
        {!! Form::open(['route' => ['users.update', $user->id], 'class' => 'form', 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'PUT']) !!}
    @else
        {!! Form::open(['route' => 'users.store', 'class' => 'form', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
    @endif

	<div class='row justify-content-center mt-3'>
        <div class="col-md-12 mb-3"><div class="form-group">
            {!! Form::text('name', $user->name ?? null, ['class' => 'form-control', 'placeholder' => 'Nome do usuario']) !!}</div></div>
        <div class="col-md-12 mb-3"><div class="form-group">
            {!! Form::email('email', $user->email ?? null, ['class' => 'form-control', 'placeholder' => 'E-mail: example@site.com.br']) !!}</div></div>
        <div class="col-md-12 mb-3"><div class="form-group">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********']) !!}</div></div>
        <div class="col-md-12">{!! Form::submit('Salvar',['class' => 'btn btn-primary pull-right']) !!}</div>
    </div>
    {!! Form::close() !!}

@endsection