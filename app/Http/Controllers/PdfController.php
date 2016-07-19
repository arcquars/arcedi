<?php

namespace App\Http\Controllers;

use App\Models\Arching;
use App\Models\PaymentM;
use App\Models\PaymentA;
use App\Models\Person;
use App\Models\Contract;
use App\Models\RentalAnti;
use App\Models\RentalMonth;
use App\Models\RentalTime;
use App\Models\Environment;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
	public function invoice()
	{
		$data = $this->getData();
		$date = date('Y-m-d');
		$invoice = "2222";
		$view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('invoice');
	}
	
	public function voucher($payment_m)
	{
		$paymentM = PaymentM::where('id', "=", $payment_m)->first();
		$person = Person::getPersonByCiS($paymentM->ci);
		$dataEnv = PaymentM::getDataFoVoucher($paymentM->rental_m_id);
		$data = $this->getData();
		$date = date('Y-m-d');
		$invoice = "2222";
		
		$arcedi = array(
				'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
				'arcedi_address' => \Config::get('arcedu.arcedi_address'),
				'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
				'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
				'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),
		);
		
		$view =  \View::make('pdf.voucher', compact('data', 'date', 'invoice', 'arcedi', 'paymentM', 'person', 'dataEnv'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('voucher');
	}

	public function voucherWaranty($rm_id)
	{
		$rentalMonth = RentalMonth::getRentalMonthById($rm_id);
		$person = Person::find( $rentalMonth->per_id);

		$name = Auth::user()->name;

		//dd($name);

		$arcedi = array(
			'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
			'arcedi_address' => \Config::get('arcedu.arcedi_address'),
			'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
			'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
			'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),
		);

		$date = date('Y-m-d');

		$view =  \View::make('pdf.invoiceWarranty', compact('data', 'date', 'arcedi', 'person', 'name', 'rentalMonth'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('pago_garantia_'.$rentalMonth->contract_id);
	}

	public function voucherWarantyAnti($ra_id)
	{
		$rentalAnti = RentalAnti::getRentalAntiById($ra_id);
		$person = Person::find( $rentalAnti->per_id);

		$name = Auth::user()->name;

		//dd($name);

		$arcedi = array(
			'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
			'arcedi_address' => \Config::get('arcedu.arcedi_address'),
			'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
			'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
			'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),
		);

		$date = date('Y-m-d');

		$view =  \View::make('pdf.invoiceWarrantyAnti', compact('data', 'date', 'arcedi', 'person', 'name', 'rentalAnti'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('pago_garantia_anticretico'.$rentalAnti->contract_id);
	}
	
	public function voucherTime($contract_id)
	{
		$contract = Contract::where('contract_id', "=", $contract_id)->first();
		$person = Person::where('id', "=", $contract->per_id)->first();;
		$rentalTime = RentalTime::where('rt_id', "=", $contract->rental_h_id)->first();
		$environment = Environment::where('env_id', "=", $contract->env_id)->first();
		
		$arcedi = array(
				'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
				'arcedi_address' => \Config::get('arcedu.arcedi_address'),
				'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
				'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
				'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),
		);
		
		$view =  \View::make('pdf.voucherTime', compact('contract', 'rentalTime', 'person', 'arcedi', 'environment'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('voucherTime');
	}

	public function contract($env_id)
	{
		$environment = Environment::getEnvironmentDetailById($env_id);
		$person = Person::where('id', "=", $environment->per_id)->first();

		$piso = "";
		if($environment->flat == 0){
			$piso = "la Planta baja";
		}else{
			$piso = "el Piso ".$environment->flat;
		}

		$arcedi = array(
			'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
			'arcedi_address' => \Config::get('arcedu.arcedi_address'),
			'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
			'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
			'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),

			'arcedi_contract_owner_name' => \Config::get('arcedu.arcedi_contract_owner_name'),
			'arcedi_contract_owner_civil' => \Config::get('arcedu.arcedi_contract_owner_civil'),
			'arcedi_contract_owner_profesion' => \Config::get('arcedu.arcedi_contract_owner_profesion'),
			'arcedi_contract_owner_ci' => \Config::get('arcedu.arcedi_contract_owner_ci'),
			'arcedi_contract_owner_address' => \Config::get('arcedu.arcedi_contract_owner_address'),
		);
		$typeUse = $environment->type_use;

		switch($typeUse){
			case "commercial":
				if($environment->rental_m_id != null){
					$view =  \View::make('pdf.contractCommercialMonth', compact('person', 'arcedi', 'environment', 'piso'))->render();
					$pdf = \App::make('dompdf.wrapper');
					$pdf->loadHTML($view);
					return $pdf->stream('contractMonth');
				}else{
					$view =  \View::make('pdf.contractCommercialAnti', compact('person', 'arcedi', 'environment', 'piso'))->render();
					$pdf = \App::make('dompdf.wrapper');
					$pdf->loadHTML($view);
					return $pdf->stream('contractAnti');
				}
				break;
			case "living_place":
				if(isset($environment->rental_m_id)){
					$view =  \View::make('pdf.contractLivingMonth', compact('person', 'arcedi', 'environment', 'piso'))->render();
					$pdf = \App::make('dompdf.wrapper');
					$pdf->loadHTML($view);
					return $pdf->stream('contractMonth');
				}else{
					$view =  \View::make('pdf.contractLivingAnti', compact('person', 'arcedi', 'environment', 'piso'))->render();
					$pdf = \App::make('dompdf.wrapper');
					$pdf->loadHTML($view);
					return $pdf->stream('contractAnti');
				}
				break;
			case "time":
				$view =  \View::make('pdf.contractTime', compact('person', 'arcedi', 'environment', 'piso'))->render();
				$pdf = \App::make('dompdf.wrapper');
				$pdf->loadHTML($view);
				return $pdf->stream('contractTime');

		}

	}
	
	public function voucherAnti($payment_anti)
	{
		$paymentA = PaymentA::where('id', "=", $payment_anti)->first();
		$person = Person::getPersonByCiS($paymentA->ci);
		$dataEnv = PaymentM::getDataFoVoucher($paymentA->rental_m_id);
		$data = $this->getData();
		$date = date('Y-m-d');
		$invoice = "2222";
	
		$arcedi = array(
				'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
				'arcedi_address' => \Config::get('arcedu.arcedi_address'),
				'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
				'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
				'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),
		);
	
		$view =  \View::make('pdf.voucherA', compact('data', 'date', 'invoice', 'arcedi', 'paymentA', 'person', 'dataEnv'))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('voucherA');
	}

	public function archingReport($arch_id){
		$arching = Arching::where('delete', "=", 1)->where("arch_id", "=", $arch_id)->first();
		$person = Person::where("id", "=", $arching->per_id)->first();

		//dd($person->id);
		$user = Auth::user();

		$arcedi = array(
			'arcedi_nameCompany' => \Config::get('arcedu.arcedi_nameCompany'),
			'arcedi_address' => \Config::get('arcedu.arcedi_address'),
			'arcedi_contact' => \Config::get('arcedu.arcedi_contact'),
			'arcedi_footer_message' => \Config::get('arcedu.arcedi_footer_message'),
			'arcedi_footer_submessage' => \Config::get('arcedu.arcedi_footer_submessage'),
		);

		$view =  \View::make('pdf.archingR', compact('arching',"person", "arcedi", "user"))->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('archingR');
	}
	
	public function getData()
	{
		$data =  [
				'quantity'      => '1' ,
				'description'   => 'some ramdom text',
				'price'   => '500',
				'total'     => '500'
		];
		return $data;
	}
}
