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
        Schema::table('users', function (Blueprint $table) {
            // Dados Pessoais
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->string('genre')->nullable();
            // Endereço
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('complement')->nullable();
            $table->string('number')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('phone')->nullable();
            // status
            $table->boolean('active')->default(true);
            // Relacionamento cidade
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cpf');
            $table->dropColumn('rg');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('genre');
            $table->dropColumn('zipcode');
            $table->dropColumn('address');
            $table->dropColumn('neighborhood');
            $table->dropColumn('complement');
            $table->dropColumn('number');
            $table->dropForeign('users_city_id_foreign');
            $table->dropColumn('city_id');
        });
    }
};
