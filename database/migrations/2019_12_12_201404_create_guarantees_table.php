<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarantees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('guarantee_type');
            $table->double('amount_guaranteed');
            $table->string('beneficiary');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('period');
            $table->string('security');
            $table->string('customer_id');
            $table->string('captured_by');
            $table->string('authorised_by')->nullable();
            $table->boolean('status')->default(false);
            $table->boolean('active')->default(true);
            $table->string('branch');
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
        Schema::dropIfExists('guarantees');
    }
}
