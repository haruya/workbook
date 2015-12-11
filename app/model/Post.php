<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	// 複数代入のブラックリスト
	protected $guarded = ['id', 'created_at', 'updated_at'];

	// 1対多のリレーション
	public function category()
	{
		return $this->belongsTo('App\model\Category');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
