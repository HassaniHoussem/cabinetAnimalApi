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
        Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('type'); // consultation, vaccin, toilettage
    $table->timestamps();
});
        Schema::create('appointments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('animal_id')->constrained();
    $table->foreignId('service_id')->constrained();
    $table->dateTime('date_heure');
    $table->enum('statut', ['en_attente', 'confirmé', 'annulé'])->default('en_attente');
    $table->text('commentaire')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
