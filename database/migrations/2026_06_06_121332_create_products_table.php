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
            $table->decimal('price', 15, 0);
            $table->integer('stock')->default(0);
            $table->decimal('discount', 5, 2);
            $table->decimal('old_price', 15, 0)->nullable();  // قیمت قبل تخفیف
            $table->string('image_1');
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->boolean('fast_delivery')->default(false);   // ← فیلتر ارسال فوری
            $table->decimal('rating', 3, 2)->default(0);        // ← میانگین امتیاز
            $table->unsignedInteger('reviews_count')->default(0); // ← تعداد نظرات
            $table->unsignedInteger('sales_count')->default(0);  // ← برای مرتب‌سازی پرفروش
            $table->string('uni_code')->nullable()->unique();
            $table->timestamps();
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
