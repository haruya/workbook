@extends('dialog')

@section('content')
<div class="container">
  <ul class="breadcrumb">
    <li>{!! link_to('/categories', 'カテゴリー一覧') !!}</li>
    <li class="active">カテゴリー詳細</li>
  </ul>
  <h2 class="text-primary">カテゴリー詳細</h2>
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
  <table class="table table-bordered table-hover">
    <tr>
      <th class="success">ID</th>
      <td>{{ $category[0]->id }}</td>
    </tr>
    <tr>
      <th class="success">カテゴリー名</th>
      <td>{{ $category[0]->name }}</td>
    </tr>
    <tr>
      <th class="success">作成日</th>
      <td>{{ $category[0]->created_at->format('Y-m-d') }}</td>
    </tr>
    <tr>
      <th class="success">更新日</th>
      <td>{{ $category[0]->updated_at->format('Y-m-d') }}</td>
    </tr>
  </table>
  <div class="pull-right">
    {!! link_to('categories/update/' . $category[0]->id, '編集', ['class' => 'btn btn-warning']) !!}&nbsp;
    <a href="#" data-toggle="modal" data-target="#deleteModal{{ $category[0]->id }}" class="btn btn-danger">削除</a>
  </div>
</div>
<!-- modal -->
<div class="modal fade" id="deleteModal{{ $category[0]->id }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>カテゴリー削除</h4>
      </div>
      <div class="modal-body">
        <p>このカテゴリーに関連する記事も削除されます。</p>
        <p>本当に削除してもよろしいですか？</p>
      </div>
      <div class="modal-footer">
        {!! Form::open(['action' => 'CategoriesController@postDelete']) !!}
          {!! Form::hidden('id', $category[0]->id) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
          {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@stop