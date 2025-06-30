<?php

use App\Models\OrderRecord;
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
        Schema::table('order_records', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 避免rollback跟Null值的欄位產生衝突
        OrderRecord::whereNull('description')
            ->update(['description' => '']);

        Schema::table('order_records', function (Blueprint $table) {
            $table->string('description')->nullable(false)->change();
        });
    }
};
