<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->integer('stock')->default(0)->after('price');

            $table->enum('stock_status', ['in_stock', 'out_of_stock'])
                ->default('in_stock')
                ->after('stock');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn(['stock', 'stock_status']);

        });
    }
};