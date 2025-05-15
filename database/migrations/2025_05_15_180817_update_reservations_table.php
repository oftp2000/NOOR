<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // 1. Vérifier si client_name existe et le supprimer
            if (Schema::hasColumn('reservations', 'client_name')) {
                $table->dropColumn('client_name');
            }

            // 2. Vérifier si client_id n'existe pas avant de l'ajouter
            if (!Schema::hasColumn('reservations', 'client_id')) {
                $table->foreignId('client_id')
                      ->nullable()  // Temporairement nullable
                      ->constrained('clients')
                      ->onDelete('cascade')
                      ->after('id');
            }
        });

        // 3. Si vous avez besoin de migrer des données, ajoutez le code ici
        // ...

        // 4. Rendre client_id non nullable si nécessaire
        Schema::table('reservations', function (Blueprint $table) {
            if (Schema::hasColumn('reservations', 'client_id')) {
                $table->foreignId('client_id')
                      ->nullable(false)
                      ->change();
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // 1. Supprimer la contrainte étrangère si elle existe
            if (Schema::hasColumn('reservations', 'client_id')) {
                $table->dropForeign(['client_id']);
                $table->dropColumn('client_id');
            }

            // 2. Recréer client_name si nécessaire
            if (!Schema::hasColumn('reservations', 'client_name')) {
                $table->string('client_name')->after('id');
            }
        });
    }
};