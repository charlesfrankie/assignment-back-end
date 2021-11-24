<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Categories:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control','minlength' => 3]) !!}
</div>


@if (Auth::user()->role !== 'author')
    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Authors:') !!}
        {!! Form::select('user_id', $users, null, ['class' => 'form-control custom-select']) !!}
    </div>
    <div class='form-group col-sm-6'>
        {!! Form::label('status', 'Status:') !!}
        {!! Form::select('status', ['Published'=> 'Published', 'Trash'=> 'Trash'], null, ['class' => 'form-control custom-select']) !!}
    </div>
    
@else
    <!-- User Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('user_id', 'Authors:') !!}
        {!! Form::select('user_id', [Auth::user()->id => Auth::user()->name], null, ['class' => 'form-control custom-select']) !!}
    </div>
    <div class='form-group col-sm-6'>
        {!! Form::label('status', 'Status:') !!}
        {!! Form::text('status', $post->status, ['class' => 'form-control', 'disabled']) !!}
    </div>
@endif


