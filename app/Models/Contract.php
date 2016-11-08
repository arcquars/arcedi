<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
	protected $table = 'contract';
	protected $primaryKey = 'contract_id';
	
	public static function getByContractByEnvId($id){
		return Contract::where('env_id', $id)->where('status', 'like', 'Vigente')->first();
	}
	
	public static function getDataPaymentMonth($env_id){
		$data = DB::table('contract')
			->join('environments', 'contract.env_id', '=', 'environments.env_id')
			->join('persons', 'contract.per_id', '=', 'persons.id')
			->join('rental_month', 'contract.rental_m_id', '=', 'rental_month.rm_id')
			->select(
					'contract.*',
					'persons.*',
				'environments.code',
					'rental_month.state as rental_state',
					'rental_month.*')
			->where('contract.env_id', $env_id)
			->where('contract.status', 'Vigente')->first();
		
		return $data;	
	}

	public static function getDataPaymentAnti($env_id){
		$data = DB::table('contract')
			->join('environments', 'contract.env_id', '=', 'environments.env_id')
			->join('persons', 'contract.per_id', '=', 'persons.id')
			->join('rental_anti', 'contract.anticrisis_id', '=', 'rental_anti.ra_id')
			->select(
				'contract.*',
				'persons.*',
				'environments.code',
				'rental_anti.*')
			->where('contract.env_id', $env_id)
			->where('contract.status', 'Vigente')->first();

		return $data;
	}

	public static function getDataContract($env_id){
		$data = DB::table('contract')
			->join('environments', 'contract.env_id', '=', 'environments.env_id')
			->join('persons', 'contract.per_id', '=', 'persons.id')
			->select(
				'contract.*',
				'persons.*',
				'environments.code')
			->where('contract.env_id', $env_id)
			->where('contract.status', 'Vigente')->first();

		return $data;
	}
	
	public static function getDataPaymentTime($env_id, $date){
		$data = DB::table('contract')
		->join('environments', 'contract.env_id', '=', 'environments.env_id')
		->join('rental_time', 'contract.rental_h_id', '=', 'rental_time.rt_id')
		->select(
				//'rental_month.date_end',
				'environments.rental',
				'rental_time.detail_time')
				->where('contract.env_id', $env_id)
				->where('rental_time.date_contract', $date)->get();
	
		return $data;
	}
	


	public static function getAllContractMonthVigente(){
		$data = DB::table('environments')
			->join('contract', 'contract.env_id', '=', 'environments.env_id')
			->select(
				'contract.rental_m_id',
				'environments.env_id',
				'environments.code')
			->where('environments.busy', 1)
			->where('contract.status', 'Vigente')
			->whereNotNull('contract.rental_m_id')->get();

		return $data;
	}

	public static function getAllContractAntiVigente(){
		$data = DB::table('environments')
			->join('contract', 'contract.env_id', '=', 'environments.env_id')
			->select(
				'contract.anticrisis_id',
				'environments.env_id',
				'environments.code')
			->where('environments.busy', 1)
			->where('contract.status', 'Vigente')
			->whereNotNull('contract.anticrisis_id')->get();

		return $data;
	}
}
