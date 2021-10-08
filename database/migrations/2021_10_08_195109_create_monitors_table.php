<?php

use App\Enums\MonitorType;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('name');
            $table->enum('monitor_type', MonitorType::asArray())->default(MonitorType::Http());
            $table->json('monitor_data')->default('{}');
            $table->integer('heartbeat_interval')->default(60);
            $table->integer('retry_interval')->default(60);
            $table->boolean('upside_down')->default(false);
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
        Schema::dropIfExists('monitors');
    }
}
