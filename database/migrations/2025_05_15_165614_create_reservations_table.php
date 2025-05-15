<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->foreignId('package_id')
                  ->constrained('packages')
                  ->onDelete('cascade');
            $table->date('date');
            $table->decimal('total', 12, 2);
            $table->enum('status', ['Confirmé','En attente','Payé partiellement','Annulé'])
                  ->default('En attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
