@extends('dialog')

@section('content')
<div class="container">
  <h2 class="text-primary">カテゴリー一覧</h2>
  @if (Session::has('flash_message'))
    <!-- フラッシュメッセージの表示 -->
    <p id="flash_message" class="alert alert-success">{{ Session::get('flash_message') }}</p>
  @endif
  
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
  <p>{!! link_to('categories/create', '新規作成', ['class' => 'btn btn-primary']) !!}</p>
  @if (count($categories) > 0)
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">カテゴリー名</th>
          <th class="text-center">作成日</th>
          <th class="text-center">更新日</th>
          <th class="text-center">操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td class="text-center">{{ $category->id}}</td>
          <td>{{ $category->name }}</td>
          <td class="text-center">{{ $category->created_at->format('Y-m-d') }}</td>
          <td class="text-center">{{ $category->updated_at->format('Y-m-d') }}</td>
          <td class="text-center">{!! link_to('categories/view/' . $category->id, '詳細', ['class' => 'btn btn-success']) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! str_replace('/?', '?', $categories->render()) !!}
  @else
    <p>カテゴリーが存在しません。</p>
  @endif
</div>
@stop