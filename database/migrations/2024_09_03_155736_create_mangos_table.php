<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create{{ modelName }}Table extends Migration
{
    public function up()
    {
        Schema::create('{{ tableName }}', function (Blueprint $table) {
            $table->id();
            // Add your columns here
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('{{ tableName }}');
    }
}
