@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <ul class="breadcrumb">
      <li>{!! link_to('/', 'TOP') !!}</li>
      <li class="active">記事詳細</li>
    </ul>
    @if (Session::has('flash_message'))
      <!-- フラッシュメッセージ表示 -->
      <p id="flash_message" class="alert alert-success">{{ Session::get('flash_message') }}</p>
    @endif
    <h3 class="bg-primary" style="padding: 5px">{{ $post->title }}</h3>
    <p class="catEria"><span class="catTag">{{ $post->category->name }}</span></p>
    <pre class="brush: c-sharp;">{{ $post->content }}</pre>
    <div class="pull-right">
      {!! link_to('posts/update/' . $post->id, '編集', ['class' => 'btn btn-warning']) !!}&nbsp;
      <a href="#" data-toggle="modal" data-target="#deleteModal{{ $post->id }}" class="btn btn-danger">削除</a>
    </div>
  </div>
</div>
<!-- modal -->
<div class="modal fade" id="deleteModal{{ $post->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title alert alert-danger">記事削除</h4>
      </div>
      <div class="modal-body">
        <p>本当に削除してもよろしいですか？</p>
      </div>
      <div class="modal-footer">
        {!! Form::open(['action' => 'PostsController@postDelete']) !!}
          {!! Form::hidden('id', $post->id) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@stop