<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusNamesTable extends Migration
{
    public function up()
    {
        Schema::create('status_names', function (Blueprint $table) {
            $table->id();
            $table->string('package_status_name');
            $table->integer('sort_order')->nullable();
            $table->boolean('print_export')->default(false);
            $table->timestamps(); // Add this line for timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_names');
    }
}
