@extends('dialog')

@section('content')
<div class="container">
  <ul class="breadcrumb">
    <li>{!! link_to('/categories', 'カテゴリー一覧') !!}</li>
    <li>{!! link_to('/categories/view/' . $category[0]->id, 'カテゴリー詳細') !!}</li>
    <li class="active">カテゴリー編集</li>
  </ul>
  <h2 class="text-primary">カテゴリー編集</h2>
  @if (Session::has('flash_message'))
    <!-- フラッシュメッセージの表示 -->
    <p id="flash_message" class="alert alert-success">{{ Session::get('flash_message') }}</p>
  @endif

  @if(count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {!! Form::open() !!}
    <div class="form-group">
      {!! Form::label('name', 'カテゴリー名', ['class' => 'control-label']) !!}
      {!! Form::text('name', $category[0]->name, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
	  {!! Form::hidden('id', $category[0]->id) !!}
      {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
    </div>
  {!! Form::close() !!}
</div>
@stop