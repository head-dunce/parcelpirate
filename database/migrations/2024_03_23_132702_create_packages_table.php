<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserID')->nullable()->constrained('users')->onDelete('set null');
            $table->string('TrackingNumber')->nullable();
            $table->string('Carrier')->nullable();
            $table->text('Description')->nullable();
            $table->string('PackageImage')->nullable();
            $table->string('PackageInvoiceImage')->nullable();
            $table->decimal('PackageValue', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
