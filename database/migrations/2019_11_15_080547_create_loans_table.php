<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_number');
            $table->string('loan_id')->unique();
            $table->string('client_id');
            $table->string('loan_amount');
            $table->date('establishment_date');
            $table->date('end_date');
            $table->string('period');
            $table->string('repayment_frequency');
            $table->string('applicable_interest');
            $table->string('applicable_penalt');
            $table->string('collateral')->nullable();
            $table->string('total_amount_payable');
            $table->string('status')->nullable()->default('103');
            $table->string('authorised_by')->nullable();
            $table->double('paid_amount')->default(0);
            $table->string('outstanding');
            $table->string('total_installments');
            $table->string('facility_category');
            $table->string('captured_by');
            $table->string('branch');
            $table->string('installment_amount');
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
        Schema::dropIfExists('loans');
    }
}
