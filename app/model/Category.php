<?php namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	// 複数代入のホワイトリスト
	protected $fillable = ['name', 'description'];

	// 1対多のリレーション
	public function Post()
	{
		return $this->hasMany('App\model\Post');
	}
}
