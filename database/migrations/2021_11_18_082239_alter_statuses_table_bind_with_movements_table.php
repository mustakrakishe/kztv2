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
        // Rename statuses table to purposes
        Schema::rename('statuses', 'purposes');

        // alter purposes table
        Schema::table('purposes', function (Blueprint $table) {

            // Rename name column to status
            $table->renameColumn('name', 'status');

            // Create description column
            $table->string('description', 50)->nullable();
        });

        // Copy purposes table status column to description one
        foreach (DB::table('purposes')->get() as $purpose){
            DB::table('purposes')->whereId($purpose->id)->update(['description' => $purpose->status]);
        }

        // Make purposes table description column not nullable
        Schema::table('purposes', function (Blueprint $table) {
            $table->string('description')->nullable(false)->change();
        });
        
        // Create movements table purpose_id column
        Schema::table('movements', function (Blueprint $table) {
            $table->foreignId('purpose_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
        });

        // Bind movements table with purposes one
        foreach (Movement::all() as $movement) {
            $movement->purpose_id = $movement->device->status_id;
            $movement->save();
        }

        // Make Movements table Purpose_id column not nullable
        Schema::table('movements', function (Blueprint $table) {
            $table->foreignId('purpose_id')->nullable(false)->change();
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
            $device->status_id = $device->movement->purpose_id;
            $device->save();
        }

        // Make devices table status_id column not nullable
        Schema::table('movements', function (Blueprint $table) {
            // Create purpose_id column
            $table->foreignId('status_id')->nullable(false)->change();
        });
        
        // Drop movements table purpose_id column
        Schema::table('movements', function (Blueprint $table) {
            $table->dropColumn('purpose_id');
        });

        // alter purposes table
        Schema::table('purposes', function (Blueprint $table) {

            // Rename status column to name
            $table->renameColumn('status', 'name');

            // Drop description column
            $table->dropColumn('description');
        });

        // Rename purposes table to statuses
        Schema::rename('purposes', 'statuses');
    }
}
