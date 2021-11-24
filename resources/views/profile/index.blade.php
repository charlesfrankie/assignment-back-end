@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> User: {{ Auth::user()->name }}</h1>
            </div>
        </div>
    </div>
</section>

<div class="card">
    <div class="card-body p-0">
        {!! Form::model($user, ['route' => ['profile.update', Auth::user()->id], 'method' => 'put']) !!}
        
        <!-- Name Field -->
        <div class="col-sm-12 my-2">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', Auth::user()->name, ['class' => 'form-control','minlength' => 3]) !!}
        </div>

        <!-- Email Field -->
        <div class="col-sm-12 my-2">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::text('email', Auth::user()->email, ['class' => 'form-control','minlength' => 3]) !!}
        </div>

        <!-- Password Field -->
        <div class="col-sm-12 my-2">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::text('password', Auth::user()->password, ['class' => 'form-control','minlength' => 3]) !!}
        </div>

        <!-- Password Field -->
        <div class="col-sm-12 my-2">
            {!! Form::label('role', 'Role:') !!}
            {!! Form::text('role', Auth::user()->role, ['class' => 'form-control','minlength' => 3, 'disabled']) !!}
        </div>
    </div>

    <div class="card-footer">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('profile.index') }}" class="btn btn-default">Cancel</a>
    </div>

    {!! Form::close() !!}
</div>
@endsection