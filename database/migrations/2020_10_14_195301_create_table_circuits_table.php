<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('ntt_cid');
            $table->string('name')->unique();
            $table->string('customer');
            $table->string('service_name');          
            $table->string('carrier_name');
            $table->string('tt2_id')->nullable();
            $table->string('province');
            $table->longText('site_description');
            $table->longText('address')->nullable();
            $table->string('al_type');
            $table->string('cable_type');
            $table->text('customer_contact');
            $table->string('recipient_to')->nullable();
            $table->string('recipient_cc')->nullable();
            $table->string('recipient_bcc')->nullable();
            $table->string('po_number')->nullable();
            $table->string('po_description')->nullable();
            $table->longText('config')->nullable();
            $table->longText('note')->nullable();
            $table->longText('update_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('circuits');
    }
}
