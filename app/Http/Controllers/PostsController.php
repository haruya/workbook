<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PostsRequest;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\model\Category;
use App\model\Post;
use Input;

class PostsController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * 記事一覧
	 */
	public function getIndex()
	{
		$allCategories = array("すべて");
		$categories = Category::where('user_id', Auth::user()->id)->lists('name', 'id');
		$allCategories += $categories;

		// 値の取得
		$title = Input::get('title');
		$category = Input::get('category_id');
		$content = Input::get('content');

		// 最新投稿順_
		$query = Post::latest('id');

		// もしタイトルがあれば
		if (!empty($query)) {
			$query->where('title', 'like', '%' . $title . '%');
		}

		// もしカテゴリーがすべて(0)でなかったら
		if ($category != 0) {
			$query->where('category_id', $category);
		}

		// もし内容があれば
		if (!empty($content)) {
			$query->where('content','like', '%' . $content . '%');
		}

		// 認証されたユーザの記事のみで1ページあたりの件数
		$posts = $query->where('user_id', Auth::user()->id)->paginate(7);

		return view('posts.index', compact('allCategories', 'categories', 'title', 'category', 'content', 'posts'));
	}

	/**
	 * 記事追加
	 */
	public function postIndex(postsRequest $request)
	{
		$post = Post::create($request->all());
		$post->user_id = Auth::user()->id;
		$post->save();
		\Session::flash('flash_message', '新規追加しました。');
		return redirect('/');
	}

	/**
	 * 記事詳細
	 */
	public function getView($id)
	{
		$post = Post::findOrFail($id);
		$this->userIdCheck($post->user_id);
		return view('posts.view')->with('post', $post);
	}

	/**
	 * 記事編集画面
	 */
	public function getUpdate($id)
	{
		$post = Post::findOrFail($id);
		$this->userIdCheck($post->user_id);
		$categories = Category::where('user_id', Auth::user()->id)->lists('name', 'id');
		return view('posts.update', compact('post', 'categories'));
	}

	/**
	 * 記事編集
	 */
	public function postUpdate(postsRequest $request)
	{
		$post = Post::findOrFail($request->id);
		$post->title = $request->title;
		$post->category_id = $request->category_id;
		$post->content = $request->content;
		$post->save();
		\Session::flash('flash_message', '編集しました。');
		return redirect('posts/view/' . $request->id);
	}

	/**
	 * 記事削除
	 */
	public function postDelete(Request $request)
	{
		$post = Post::findOrFail($request->id);
		$post->delete();
		\Session::flash('flash_message', '削除しました。');
		return redirect('/');
	}

	/**
	 * カテゴリーの作成
	 */
	public function postCategoryCreate(Request $request)
	{
		$category = Category::where('name', $request->name)->where('user_id', $request->user_id)->get();
		if (count($category) == 0) {
			$data = [
				'user_id' => $request->user_id,
				'name' => $request->name
			];
			Category::create($data);
		}
		\Session::flash('flash_message', 'カテゴリーを作成しました。');
		return redirect()->back();
	}

	/**
	 * アクセスしたユーザがそのアクセスに対し、権限があるか
	 */
	private function userIdCheck($userId)
	{
		if (Auth::user()->id != $userId) {
			abort(403, 'アクセス権限がありません。');
		}
	}

}
