<?php

use App\Models\Device;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDevicesTableAddUpdatedAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable();
        });

        $searchableRelationships = [
            'last_movement',
            'last_repair',
            'last_hardware',
            'last_software',
        ];

        foreach(Device::all() as $device){
            $lastChangesDates = collect();

            foreach($searchableRelationships as $relationship){
                if(method_exists(Device::class, $relationship)){
                    $timestamp = strtotime($device->$relationship?->date);
                    $lastChangesDates->push($timestamp);
                }
            }

            $updatedAt = $lastChangesDates->max();

            Device::find($device->id)->update([
                'updated_at' => date('Y-m-d', $updatedAt) . 'T' . date('H:i:s', $updatedAt),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('updated_at');
        });
    }
}
