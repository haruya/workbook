<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkbookTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// roleテーブル作成
		Schema::create('roles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 16)->unique();
			$table->timestamps();
		});

		// categoriesテーブルの作成
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name', 64);
			$table->integer('not_delete_flag')->default(0);
			$table->timestamps();
		});

		// postsテーブルの作成
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('category_id');
			$table->string('title', 64);
			$table->text('content');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
		Schema::drop('categories');
		Schema::drop('posts');
	}

}
