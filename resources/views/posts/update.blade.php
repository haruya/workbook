@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <ul class="breadcrumb">
      <li>{!! link_to('/', 'TOP') !!}</li>
      <li>{!! link_to('posts/view/' . $post->id, '記事詳細') !!}</li>
      <li class="active">記事編集</li>
    </ul>
    @if (Session::has('flash_message'))
      <!-- フラッシュメッセージ表示 -->
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
        {!! Form::submit('編集', ['class' => 'btn btn-warning']) !!}&nbsp;
        <span id="catLink" class="btn btn-warning">カテゴリー操作</span>
      </div>
    {!! Form::close() !!}
  </div>
</div>
<!-- category_dialog -->
<div id="catDialog" title="カテゴリー操作">
  <iframe src="{{ asset('/categories/') }}" width="100%" height="500px" frameborder="0"></iframe>
</div>
@stop