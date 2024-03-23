<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageStatusTable extends Migration
{
    public function up()
    {
        Schema::create('package_status', function (Blueprint $table) {
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->constrained('status_names')->onDelete('cascade');
            $table->timestamp('timestamp')->useCurrent();
            $table->primary(['package_id', 'status_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_status');
    }
}

