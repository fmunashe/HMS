<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loan_id');
            $table->string('period');
            $table->string('opening_balance');
            $table->double('interest');
            $table->string('installment');
            $table->string('capital_repayment');
            $table->string('closing_balance');
            $table->double('overdue')->nullable()->default(0);
            $table->string('paid_amount')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('loan_schedules');
    }
}
