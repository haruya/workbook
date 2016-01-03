<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\model\Category;
use App\model\Post;

class CategoriesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	 * カテゴリー一覧
	 */
	public function getIndex()
	{
		$categories = Category::where('user_id', Auth::user()->id)
			->where('not_delete_flag', 0)->orderBy('id', 'asc')->paginate(10);
		return view('categories.index')->with('categories', $categories);
	}

	/**
	 * カテゴリ詳細
	 */
	public function getView($id)
	{
		$category = Category::where('user_id', Auth::user()->id)
			->where('id', $id)->where('not_delete_flag', 0)->get();
		if (count($category) == 0) {
			abort(404, 'ページが存在しません。');
		}
		return view('categories.view')->with('category', $category);
	}
	
	/*
	 * カテゴリー追加画面
	 */
	public function getCreate()
	{
		return view('categories.create');
	}
	
	/**
	 * カテゴリー追加
	 */
	public function postCreate(CategoryRequest $request)
	{
		$categoryData = [
			'user_id' => $request->user_id,
			'name' => $request->name,
			'not_delete_flag' => 0,
		];
		
		DB::transaction(function() use($categoryData) {
			$category = Category::create($categoryData);
		});
		
		\Session::flash('flash_message', 'カテゴリーを追加しました。');
		return redirect('/categories');
	}
	
	/**
	 * カテゴリー編集画面
	 */
	public function getUpdate($id)
	{
		$category = Category::where('user_id', Auth::user()->id)
			->where('id', $id)->where('not_delete_flag', 0)->get();
		if (count($category) == 0) {
			abort(404, 'ページが存在しません。');
		}
		return view('categories.update')->with('category', $category);
	}
	
	/**
	 * カテゴリー編集
	 */
	public function postUpdate(CategoryRequest $request)
	{
		$category = Category::findOrFail($request->id);
		$category->name = $request->name;
		$category->save();
		\Session::flash('flash_message', '編集しました。');
		return redirect('categories/view/' . $request->id);
	}
	
	/**
	 * カテゴリー削除
	 */
	public function postDelete(Request $request)
	{
		$category = Category::findOrFail($request->id);
		DB::transaction(function() use($category) {
			$category->delete();
			Post::where('category_id', $category->id)->delete();
		});
		$category->delete();
		\Session::flash('flash_message', '削除しました。');
		return redirect('/categories');
	}

}
