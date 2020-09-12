<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->string('name',55);
            $table->string('slug',111)->unique();

            $table->text('details')->nullable();
            $table->boolean('active');

            $table->foreignId('created_by')->nullable()->constrained('users', 'id')
                ->onUpdate('cascade')->onDelete('set null');

            $table->foreignId('updated_by')->nullable()->constrained('users', 'id')
                ->onUpdate('cascade')->onDelete('set null');

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
        Schema::dropIfExists('product_versions');
    }
}
