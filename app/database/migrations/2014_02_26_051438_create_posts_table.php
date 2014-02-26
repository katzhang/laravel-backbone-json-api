<?php

use Illuminate\Database\Migrations\Migration as Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->integer('id', true);
			$table->string('title');
			$table->text('content');
			$table->string('author_name');
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
		Schema::drop('posts');
	}

}
