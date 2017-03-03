<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Environment extends Model
{
	protected $table = 'environments';
	protected $primaryKey = 'env_id';

    /*
	public function scopeFreesearch($query, $value)
    {
        return $query->where('title','like','%'.$value.'%')
            ->orWhere('body','like','%'.$value.'%')
            ->orWhereHas('author', function ($q) use ($value) {
                $q->whereRaw(" CONCAT(firstname, ' ', lastname) like ?", array("%".$value."%"));
            })->orWhereHas('categories', function ($q) use ($value) {
                $q->where('name','like','%'.$value.'%');
            });

    }
    */

    public static function getByIdS($id){
    	return Environment::where('env_id', '=', $id)->first();
    }

    public static function getEnvironmentDetailById($env_id){
        $data = DB::table('environments')
            ->join('contract', 'contract.env_id', '=', 'environments.env_id')
            ->select(
                'contract.per_id',
                'contract.contract_id',
                'contract.rental_m_id',
                'contract.rental_h_id',
                'contract.anticrisis_id',
                'contract.date_contract',
                'environments.env_id',
                'environments.flat',
                'environments.area',
                'environments.detail_env',
                'environments.type_use',
                'environments.code')
            ->where('environments.env_id', $env_id)->where('contract.status', "Vigente")->first();

        return $data;

    }
}
