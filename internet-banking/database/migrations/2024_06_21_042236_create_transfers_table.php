<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string('from_account');
            $table->string('to_account');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
            $table->string('transaction_type')->default('transfer'); // e.g., 'transfer', 'deposit', 'withdrawal'
        });
    }

    public function down()
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->dropColumn('transaction_type');
        });
    }
}
