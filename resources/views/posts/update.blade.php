@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <ul class="breadcrumb">
      <li>{!! link_to('/', 'TOP') !!}</li>
      <li>{!! link_to('posts/view/' . $post->id, '記事詳細') !!}</li>
      <li class="active">記事編集</li>
    </ul>
    @if ($errors->all())
      <!-- エラーメッセージ表示 -->
      @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
      @endforeach
    @endif
    <h3 class="bg-primary" style="padding: 5px">記事編集</h3>
    {!! Form::open() !!}
      <div class="form-group">
        {!! Form::label('title', 'タイトル', ['class' => 'control-label']) !!}
        {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('category_id', 'カテゴリー', ['class' => 'control-label']) !!}
        {!! Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('content', '内容', ['class' => 'control-label']) !!}
        {!! Form::textarea('content', $post->content, ['class' => 'form-control', 'rows' => 5]) !!}
      </div>
      <div class="form-group">
        {!! Form::hidden('id', $post->id) !!}
        {!! Form::submit('編集', ['class' => 'btn btn-warning']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
@stop