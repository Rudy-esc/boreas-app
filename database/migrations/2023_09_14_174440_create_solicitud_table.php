<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('NombreSolicitud', 50);
            $table->date('FechaSolicitud');
            $table->date('FechaEntregaSolicitud');
            $table->time('HoraInicio');
            $table->time('HoraFin');
            $table->string('PeticionSolicitud', 100);
            $table->unsignedBigInteger('UsuariosId');
            $table->unsignedBigInteger('SitiosId');
            $table->unsignedBigInteger('ObjetosId');
            $table->timestamps();

            $table->foreign('SitiosId')->references('id')->on('sitios');
            $table->foreign('ObjetosId')->references('id')->on('objetos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sitios');
    }
};
