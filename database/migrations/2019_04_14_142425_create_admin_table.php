<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{

    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        DB::table('admin_users')->insert(
            array(
                'email' => 'admin@laraveladminpanel.com',
                'password' => bcrypt('123456'),
                'name' => "Admin"
            )
        );
    }

    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
