<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// It's not able to reverse all acts
// cause of losing information about
// which characteristics was imported
// from the Modernizations or the Repairs.

class synthesizeHardwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create [conditions].[date], [conditions].[comment]

        Schema::table('conditions', function (Blueprint $table) {
            $table->timestamp('date')->useCurrent();
            $table->text('comment')->nullable();
        });

        // Copy each [repairs].[date], [repairs].[cause]
        // to [conditions].[date], [conditions].[comment]

        $repairs = DB::table('repairs')->get();
        foreach($repairs as $repair){
            DB::table('conditions')->whereId($repair->condition_id)->update([
                'date' => $repair->date,
                'comment' => $repair->cause,
            ]);
        }

        // Copy each [modernizations].[date], [modernizations].[comment]
        // to [conditions].[date], [conditions].[comment]

        $modernizations = DB::table('modernizations')->get();
        foreach($modernizations as $modernization){
            DB::table('conditions')->whereId($modernization->condition_id)->update([
                'date' => $modernization->date,
                'comment' => $modernization->comment ?? 'Модернизация',
            ]);
        }

        // Set not nullable constraint on [conditions].[comment]

        Schema::table('conditions', function (Blueprint $table){
            $table->text('comment')->nullable(false)->change();
        });

        // Drop [modernizations]

        Schema::dropIfExists('modernizations');

        // Create [repairs].[device_id]

        Schema::table('repairs', function (Blueprint $table) {
            $table->foreignId('device_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
        });

        // Copy [conditions].[device_id]
        // to each [repairs].[device_id]

        $repairs = DB::table('repairs')->get();
        foreach($repairs as $repair){
            $condition = DB::table('conditions')->find($repair->condition_id);
            DB::table('repairs')->whereId($repair->id)->update([
                'device_id' => $condition->device_id,
            ]);
        }

        // Reset nullable constraint on [repairs].[device_id],
        // drop [repairs].[condition_id]

        Schema::table('repairs', function (Blueprint $table) {
            $table->foreignId('device_id')->nullable(false)->change();
            $table->dropColumn('condition_id');
        });

        // Rename [conditions]
        // to [hardwares]

        Schema::rename('conditions', 'hardwares');

        // Rename [hardwares].[characteristics]
        // to [hardwares].[description]

        Schema::table('hardwares', function (Blueprint $table) {
            $table->renameColumn('characteristics', 'description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Rename [hardwares].[description]
        // to [hardwares].[characteristics]

        Schema::table('hardwares', function (Blueprint $table) {
            $table->renameColumn('description', 'characteristics');
        });

        // Rename [hardwares]
        // to [conditions]

        Schema::rename('hardwares', 'conditions');

        // Set nullable constraint on [repairs].[device_id],
        // create [repairs].[condition_id]

        Schema::table('repairs', function (Blueprint $table) {
            $table->foreignId('device_id')->nullable()->change();
            $table->foreignId('condition_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
        });
    }
}
