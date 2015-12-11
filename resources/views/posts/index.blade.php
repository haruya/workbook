@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <h3 class="text-success" style="">記事検索</h3>
      {!! Form::open(['method' => 'get']) !!}
        <div class="form-group">
          {!! Form::label('title', 'タイトル', ['class' => 'control-label']) !!}
          {!! Form::text('title', $title, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category_id', 'カテゴリー', ['class' => 'control-label']) !!}
          {!! Form::select('category_id', $allCategories, $category, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('content', '内容', ['class' => 'control-label']) !!}
          {!! Form::text('content', $content, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::submit('検索', ['class' => 'btn btn-success']) !!}
        </div>
      {!! Form::close() !!}
    </div>
    <div class="col-sm-9">
      <h2 class="text-primary">記事追加</h2>
      @if (Session::has('flash_message'))
        <!-- フラッシュメッセージ表示 -->
        <p id="flash_message" class="alert alert-success">{{ Session::get('flash_message') }}</p>
      @endif

      @if ($errors->all())
        <!-- エラーメッセージ表示 -->
        @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
      @endif
      {!! Form::open(['action' => 'PostsController@postIndex']) !!}
        <div class="form-group">
          {!! Form::label('title', 'タイトル', ['class' => 'control-label']) !!}
          {!! Form::text('title', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('category_id', 'カテゴリー', ['class' => 'control-label']) !!}
          {!! Form::select('category_id', $categories, '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('content', '内容', ['class' => 'control-label']) !!}
          {!! Form::textarea('content', '', ['class' => 'form-control', 'rows' => 5]) !!}
        </div>
        <div class="form-group">
          {!! Form::submit('追加', ['class' => 'btn btn-primary']) !!}
        </div>
      {!! Form::close() !!}
      <h2 class="text-primary">記事一覧</h2>
      @if(count($posts) > 0)
        @foreach($posts as $post)
          <h3 class="bg-primary" style="padding: 5px">
            {!! link_to('posts/view/' . $post->id, $post->title, ['style' => 'color: #ffffff']) !!}
            <span style="font-size: 70%">({{ $post->created_at->format('Y-m-d') }})</span>
          </h3>
          <p class="catEria"><span class="catTag">{{ $post->category->name }}</span></p>
          <pre class="brush: c-sharp;">{{ $post->content }}</pre>
        @endforeach
        <!-- title, category_id, contentがあればパラメータに含める -->
        {!! $posts->appends(['title' => $title, 'category_id' => $category, 'content' => $content]) !!}
      @else
        <p>記事が存在しません。</p>
      @endif
    </div>
  </div>
</div>
@stop