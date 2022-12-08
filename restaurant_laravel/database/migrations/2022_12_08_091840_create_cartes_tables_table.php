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
        Schema::create('cartes_tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Carte::class, 'carte_id')
            ->constrained()
            ->onUpdate('RESTRICT')
            ->onDelete('RESTRICT');
            $table->foreignIdFor(\App\Models\Table::class, 'table_id')
            ->constrained()
            ->onUpdate('RESTRICT')
            ->onDelete('RESTRICT');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartes_tables');
    }
};
