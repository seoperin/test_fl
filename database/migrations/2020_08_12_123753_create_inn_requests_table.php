<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInnRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('inn_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->boolean('is_success');
            $table->text('message');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inn_requests');
    }
}
