<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role;
use App\model\Category;
use App\model\Post;

class UsersController extends Controller {

	public function __construct()
	{
		$this->middleware('auth.admin');
	}

	/**
	 * ユーザ一覧
	 */
	public function getIndex()
	{
		$users = User::orderBy('id', 'asc')->paginate(10);
		return view('users.index')->with('users', $users);
	}

	/**
	 * ユーザ詳細
	 */
	public function getView($id)
	{
		$user = User::findOrFail($id);
		return view('users.view')->with('user', $user);
	}

	/**
	 * ユーザ追加画面
	 */
	public function getCreate()
	{
		$roles = $this->getRoleList();
		return view('users.create')->with('roles', $roles);
	}

	/**
	 * ユーザ追加
	 */
	public function postCreate(UserRequest $request)
	{
		$userData = [
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'role_id' => $request->role_id,
		];

		DB::transaction(function() use($userData) {
			$user = User::create($userData);
			$categoryData = [
				'user_id' => $user->id,
				'name' => 'メモ',
				'not_delete_flag' => 1,
			];
			Category::create($categoryData);
		});

		\Session::flash('flash_message', 'ユーザを追加しました。');
		return redirect('/users');
	}

	/**
	 * ユーザ編集画面
	 */
	public function getUpdate($id)
	{
		$user = User::findOrFail($id);
		$roles = $this->getRoleList();
		return view('users.update', compact('user', 'roles'));
	}

	/**
	 * ユーザ編集
	 */
	public function postUpdate(UserRequest $request)
	{
		if ($request->id == Auth::user()->id) {
			return redirect()->back()->withErrors(['現在ログイン中なので変更できません。']);
		}
		$user = User::findOrFail($request->id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->role_id = $request->role_id;
		$user->save();
		\Session::flash('flash_message', '編集しました。');
		return redirect('users/view/' . $request->id);
	}


	/**
	 * ユーザ削除
	 */
	public function postDelete(Request $request)
	{
		if ($request->id == Auth::user()->id) {
			return redirect()->back()->withErrors(['現在ログイン中なので削除できません。']);
		}
		$user = User::findOrFail($request->id);
		DB::transaction(function() use($user) {
			$user->delete();;
			Category::where('user_id', $user->id)->delete();
			Post::where('user_id', $user->id)->delete();
		});
		$user->delete();
		\Session::flash('flash_message', '削除しました。');
		return redirect('/users');
	}

	/**
	 * 権限の作成
	 */
	public function postRoleCreate(Request $request)
	{
		$role = Role::firstOrCreate($request->only('name'));
		$role->save();
		\Session::flash('flash_message', '権限を作成しました。');
		return redirect()->back();
	}

	/**
	 * 権限取得
	 */
	private function getRoleList()
	{
		$roles = array('' => '選択してください');
		$roles += Role::orderBy('id', 'asc')->lists('name', 'id');
		return $roles;
	}

}
