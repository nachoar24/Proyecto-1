<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->string('title')->default('Untitled idea')->after('id');
            $table->json('links')->nullable()->after('user_id');
            $table->string('status')->default('pending')->after('links');
            $table->string('image_path')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'links',
                'status',
                'image_path',
            ]);
        });
    }
};
