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
    Schema::create('products', function (Blueprint $table) {
      $table->id();

      $table->string('name');
      $table->text('description');
      $table->decimal('price', 8, 2);
      $table->string('image')->nullable();
      $table->enum('status', ['active', 'inactive'])->default('inactive');
      $table->integer('quantity')->default(0);
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamp('created_at');
      $table->timestamp('updated_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
