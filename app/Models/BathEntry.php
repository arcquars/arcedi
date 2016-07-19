<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BathEntry extends Model
{
    protected $table = 'bacth_entry';
    protected $primaryKey = 'be_id';

    public static function bathEntryTotalBeetwenDate($dateStart, $dateEnd){
        $granTotal = BathEntry::where('created_at', '>=', $dateStart)->where('created_at', '<=', $dateEnd)->sum('amount');

        return $granTotal;
    }
}
