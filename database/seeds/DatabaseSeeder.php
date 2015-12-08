<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Carbon\Carbon;
use App\model\Category;
use App\model\Post;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CategoriesTableSeeder');
		$this->call('PostsTableSeeder');

		Model::reguard();
	}

}

class CategoriesTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('categories')->delete();
		$categoryList = array(
				"HTML", "CSS", "PHP", "MYSQL", "javascript",
				"jQuery", "jQuery UI", "CakePHP", "仕事", "java",
				"CentOS", "ネットワーク", "Excel", "VBA", "ECサイト",
				"車", "git", "AWS", "laravel", "phalcon"
		);

		for ($i = 0; $i < count($categoryList); $i++) {
			Category::create([
			'name' => $categoryList[$i]
			]);
		}
	}

}

class PostsTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('posts')->delete();
		$faker = Faker::create('ja_JP');

		for ($i = 0; $i < 10; $i++) {
			if ($i >= 5) {
				$categoryId = 2;
			} else {
				$categoryId = 1;
			}
			Post::create([
				'user_id' => 1,
				'category_id' => $categoryId,
				'title' => $faker->sentence(),
				'content' => $faker->paragraph()
			]);
		}
	}
}
