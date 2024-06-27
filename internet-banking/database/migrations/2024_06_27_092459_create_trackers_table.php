<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackersTable extends Migration
{
    public function up()
    {
        Schema::create('trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_type'); // 'deposit', 'withdrawal', 'transfer'
            $table->decimal('total_amount', 15, 2);
            $table->date('transaction_date'); // Store the date of the transaction
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trackers');
    }
}
