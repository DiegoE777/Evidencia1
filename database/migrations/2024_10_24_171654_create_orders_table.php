<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('salesperson_id')->constrained('users'); // Vendedor que tomó el pedido
            $table->string('invoice_number')->unique();
            $table->enum('status', ['Ordered', 'In process', 'In route', 'Delivered']);
            $table->text('notes')->nullable();
            $table->string('route_photo')->nullable(); // Para foto de la carga
            $table->string('delivery_photo')->nullable(); // Para foto de entrega
            $table->timestamps();
            $table->softDeletes(); // Para soporte de eliminaciones lógicas

            $table->unsignedBigInteger('client_id');  // Relación con clientes
            $table->enum('status', ['Ordered', 'In process', 'In route', 'Delivered']);
            $table->timestamps();
            // Clave foránea
            $table->foreign('client_id')->references('id')->on('clients');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
