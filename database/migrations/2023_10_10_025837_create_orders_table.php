<?php

use App\Models\Order;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->enum('status', [Order::PENDIENTE, Order::PROCESO, Order::PAGADO, Order::ENPAQUETERIA, Order::ENVIADO, Order::ENTREGADO, Order::ANULADO])->default(Order::PENDIENTE);

            $table->string('carrier_name');
            $table->string('carrier_service');
            $table->string('tracking_number')->nullable();

            $table->decimal('shipping_cost');
            $table->decimal('subtotal');
            $table->decimal('total');

            $table->json('content');
            $table->json('data')->nullable();

            $table->string('payment_method');
            $table->string('transaction_id');

            $table->string('ip_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
