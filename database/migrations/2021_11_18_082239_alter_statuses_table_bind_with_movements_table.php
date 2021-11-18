<?php

use App\Models\Device;
use App\Models\Movement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStatusesTableBindWithMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Create movements table status_id column
        Schema::table('movements', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onUpdate('cascade')->onDelete('cascade');
        });

        // Bind movements table with purposes one
        foreach (Movement::all() as $movement) {
            $movement->status_id = $movement->device->status_id;
            $movement->save();
        }

        // Make movements table status_id column not nullable
        Schema::table('movements', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable(false)->change();
        });

        // Drop devices table status_id column
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create devices table status_id column
        Schema::table('devices', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onUpdate('cascade')->onDelete('cascade');
        });

        // Bind devices table with purposes one
        foreach (Device::all() as $device) {
            $device->status_id = $device->movement->status_id;
            $device->save();
        }

        // Make devices table status_id column not nullable
        Schema::table('movements', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable(false)->change();
        });
        
        // Drop movements table purpose_id column
        Schema::table('movements', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
}
