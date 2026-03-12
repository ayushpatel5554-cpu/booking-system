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
        Schema::create('vendors', function (Blueprint $table) {
        $table->id();
        $table->string('shop_name', 255); // દુકાનનું નામ
        $table->string('owner_name', 255); // માલિકનું નામ
        $table->string('contact_number', 15)->unique(); // મોબાઈલ નંબર
        $table->string('email')->unique(); // ઈમેઈલ
        $table->text('address')->nullable(); // સરનામું
        $table->string('password'); // લોગિન પાસવર્ડ
        $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
