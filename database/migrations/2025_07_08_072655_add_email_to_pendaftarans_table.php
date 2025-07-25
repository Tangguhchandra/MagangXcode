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
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->string('email')->after('nama'); // atau atur posisinya sesuai kebutuhan
            });
        }

        public function down()
        {
            Schema::table('pendaftarans', function (Blueprint $table) {
                $table->dropColumn('email');
            });
        }

};
