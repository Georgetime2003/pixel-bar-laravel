<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('product_label_translations')) {
            Schema::create('product_label_translations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('label_id');
                $table->string('locale', 5);
                $table->string('name');
                $table->timestamps();
                $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
                $table->unique(['label_id', 'locale']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('product_label_translations')) {
            Schema::dropIfExists('product_label_translations');
        }
    }
};
