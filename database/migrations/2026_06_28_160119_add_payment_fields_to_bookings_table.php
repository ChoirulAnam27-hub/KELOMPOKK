<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('payment_type', ['dp', 'lunas'])->default('lunas')->after('total_price');
            $table->decimal('amount_paid', 10, 2)->default(0)->after('payment_type');
            $table->decimal('remaining_payment', 10, 2)->default(0)->after('amount_paid');
            $table->enum('payment_status', ['unpaid', 'dp_paid', 'paid'])->default('unpaid')->after('remaining_payment');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'amount_paid', 'remaining_payment', 'payment_status']);
        });
    }
};

