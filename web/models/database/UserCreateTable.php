<?php
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;
  class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     * @return void
     */
    public function up() {
      Schema::create('Users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email,100)->default("")');
        $table->timestamps();
      });
    }
    /**
     * Reverse the migrations.
     * @return void
     */
    public function down() {
      Schema::drop('Users');
    }
  }
