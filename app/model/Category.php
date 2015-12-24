<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	// 複数代入のホワイトリスト
	protected $fillable = ['name', 'user_id', 'not_delete_flag'];

	// 1対多のリレーション
	public function Post()
	{
		return $this->hasMany('App\model\Post');
	}

	// 1対多のリレーション
	public function User()
	{
		return $this->belongsTo('App\User');
	}
}
