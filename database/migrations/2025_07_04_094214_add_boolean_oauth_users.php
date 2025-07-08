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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'boolean_oauth')) {
                $table->boolean('boolean_oauth')->default(false)->after('remember_token');
            }
            $table->string('avatar')->default('https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y')->after('boolean_oauth');
        });
        Schema::create('oauth_users', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
