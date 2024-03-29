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
            // Rename UserID to user_id and adjust the foreign key constraint accordingly
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('TrackingNumber')->nullable();
            $table->string('Carrier')->nullable();
            $table->text('Description')->nullable();
            $table->string('PackageImage')->nullable();
            $table->string('PackageInvoiceImage')->nullable();
            $table->decimal('PackageValue', 10, 2)->nullable();
            $table->timestamps();

            // Assuming status_id is correctly set up
            $table->foreignId('status_id')->nullable()->constrained('status_names')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('status_id');
            // Also ensure to drop the correct foreign key and column
            $table->dropConstrainedForeignId('user_id');
        });

        Schema::dropIfExists('packages');
    }
}
