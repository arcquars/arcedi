<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Extra extends Model
{
    protected $table = 'extra';
    protected $primaryKey = 'extra_id';

    public static function getDataForExtra($extra_id){
        $data = DB::table('extra')
            ->join('contract', 'contract.contract_id', '=', 'extra.contract_id')
            ->join('environments', 'contract.env_id', '=', 'environments.env_id')
            ->join('persons', 'persons.id', '=', 'contract.per_id')
            ->select(
                'contract.contract_id',
                'environments.code',
                'environments.type',
                'persons.ci',
                'persons.names',
                'persons.last_name_f',
                'persons.last_name_m',
                'persons.expedido',
            'extra.extra_id',
            'extra.detail',
            'extra.total',
            'extra.date_extra',
            'extra.user_id')
            ->where('extra.extra_id', $extra_id)->first();
        return $data;

    }

    public static function totalExtraBeetwen($dateStart, $dateEnd){
        $granTotal = Extra::where('date_extra', '>=', $dateStart)->where('date_extra', '<=', $dateEnd)->sum('total');
        return array(
            "granTotal" => $granTotal

        );
    }
}
