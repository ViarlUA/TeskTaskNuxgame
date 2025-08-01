<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('access_tokens',
            static function (Blueprint $table) {
                $table->id();
                
                $table->string('token')
                    ->unique();
                $table->unsignedBigInteger('user_id');
                
                $table->timestamp('expires_at');
                $table->timestamp('deactivated_at')
                    ->nullable();
                
                $table->timestamps();
                
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_tokens');
    }
};
