<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\SystemConstantHelper;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('meta_title',190);
            $table->text('meta_description');
            $table->string('meta_keywords',255);
            $table->enum('status',SystemConstantHelper::STATUSES)->default(SystemConstantHelper::STATUS_ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
