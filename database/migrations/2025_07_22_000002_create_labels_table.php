<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
        });

        // Només afegeix la columna si no existeix
        if (!Schema::hasColumn('products', 'label_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('label_id')->nullable()->after('category_id');
                $table->foreign('label_id')->references('id')->on('labels')->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'label_id')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropForeign(['label_id']);
                $table->dropColumn('label_id');
            });
        }
        Schema::dropIfExists('labels');
    }
};
