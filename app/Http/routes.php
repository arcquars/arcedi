<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/contact', function () {
        return view('contact');
    });
});

Route::group(['middleware' => ['web']], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/grid', 'AdminController@getGrid');
    
    Route::get('/admin/typeRental/{env_id?}', 'AdminController@getRentalPayment');
    Route::get('/admin/dataContrac/{env_id?}', 'AdminController@getDataContracByEnvId');
    Route::post('/admin/contrato', 'AdminController@postContrato');
    Route::post('/admin/contratoAnti', 'AdminController@postContratoAnti');
    Route::post('/admin/contratoTime', 'AdminController@postContratoTime');
    Route::post('/admin/paymentMonth', 'AdminController@postPaymentMonth');
    Route::post('/admin/paymentWMonth', 'AdminController@postPaymentWMonth');
    Route::post('/admin/paymentWAnti', 'AdminController@postPaymentWAnti');
    Route::post('/admin/paymentAnti', 'AdminController@postPaymentAnti');
    Route::post('/admin/paymentExtra', 'AdminController@postPaymentExtra');
    Route::get('/admin/dataRentMonth/{env_id?}', 'AdminController@getPaymentContractMonth');
    Route::get('/admin/dataRentTime/{env_id?}/{date?}', 'AdminController@getPaymentContractTime');
    Route::get('/admin/dataRentAnti/{env_id?}', 'AdminController@getPaymentContractAnti');

    Route::get('/admin/getEnvImages/{env_id?}', 'AdminController@getEnvImages');
    Route::get('/admin/endContract/{env_id?}', 'AdminController@actionEndContract');

    //Route::get('/person', 'PersonController@show');
    Route::resource('/person', 'PersonController');

    Route::get('/env', 'EnvironmentController@index');
    Route::get('/env/new', 'EnvironmentController@newEnv');
    Route::get('/env/edit/{env_id}', 'EnvironmentController@editEnv');
    Route::get('/env/env_images/{env_id}', 'EnvironmentController@getEnvImages');
    Route::post('/env', 'EnvironmentController@store');
    Route::post('/env/upload', 'EnvironmentController@uploadFile');
    Route::delete('/env/{env_image_id}', 'EnvironmentController@destroy');
    Route::get('/env/listContract/{env_id}', 'EnvironmentController@getEnvContract');
    Route::get('/env/redirectContractExtra/{contract_id}', 'EnvironmentController@paymentContractExtra');
    Route::get('/env/redirectContract/{contract_id}', 'EnvironmentController@redirectContract');
    Route::get('/env/paymentsContractMonth/{contract_id}/{rental_m_id}', 'EnvironmentController@paymentContractMonth');
    Route::get('/env/paymentsContractAnti/{contract_id}/{rental_a_id}', 'EnvironmentController@paymentContractAnti');
    Route::delete('/env/del/{env_id}', 'EnvironmentController@destroyEnv');

    Route::get('/pdf', 'PdfController@invoice');
    Route::get('/pdf/voucher/{payment_m}', 'PdfController@voucher');
    Route::get('/pdf/voucherWarrantyMonth/{rm_id}', 'PdfController@voucherWaranty');
    Route::get('/pdf/voucherWarrantyAnti/{ra_id}', 'PdfController@voucherWarantyAnti');
    Route::get('/pdf/voucherTime/{contract_id}', 'PdfController@voucherTime');
    Route::get('/pdf/voucherAnti/{payment_anti}', 'PdfController@voucherAnti');
    Route::get('/pdf/voucherExtra/{extra_id}', 'PdfController@voucherExtra');
    Route::get('/pdf/contract/{env_id}', 'PdfController@contract');
    Route::get('/pdf/archingReport/{arch_id}', 'PdfController@archingReport');
    
    // Route gastos
    Route::get('/expenses', 'ExpenseController@index');
    Route::post('/expenses/save', 'ExpenseController@postExpenseSave');
    Route::get('/expenses/{exp_id?}', 'ExpenseController@getExpense');
    Route::get('/expenses/delete/{exp_id?}', 'ExpenseController@getDeleteExpense');
    
    // Route arqueos
    Route::get('/arching', 'ArchingController@index');
    Route::get('/arching/bath', 'ArchingController@actionBath');
    Route::post('/arching', 'ArchingController@saveArching');
    Route::post('/arching/saveArchingBath', 'ArchingController@saveArchingBath');

    // Route reportes
    Route::get('/reports', 'ReportsController@index');
    
    // Route baños
    Route::get('/bath', 'BathController@index');
    Route::get('/bath/outgo', 'BathController@outgo');
    Route::get('/bath/getDateEntry', 'BathController@getDayEntryRegistry');
    Route::post('/bath/save', 'BathController@postBathSave');
    Route::post('/bath/saveSpending', 'BathController@postBathSpendingSave');
    Route::delete('/bath/deleteSpending/{id?}', 'BathController@destroyBathSpending');

    Route::get('/store', 'StoreController@index');
    Route::post('/store/newProduct', 'StoreController@postNewProduct');
    Route::post('/store/editProduct', 'StoreController@postEditProduct');
    Route::get('/store/validCodeProduct/{value?}', 'StoreController@validCodeProduct');
    Route::get('/store/validNameProduct/{value?}', 'StoreController@validNameProduct');
    Route::get('/store/getProduct/{product_id?}', 'StoreController@getProduct');
    Route::get('/store/findTypeAhead', 'StoreController@findTypehead');
    Route::get('/store/findTypeAheadSale', 'StoreController@findTypeheadSale');
    Route::get('/store/findTypeAheadStoreMovements', 'StoreController@findTypeAheadStoreMovements');
    Route::get('/store/buy/{ids?}', 'StoreController@buyByIds');
    Route::get('/store/buyProducts', 'StoreController@buyProducts');
    Route::get('/store/saleProducts', 'StoreController@saleProducts');
    Route::get('/store/deliveryProducts', 'StoreController@deliveryProducts');
    Route::get('/store/refundProducts', 'StoreController@refundProducts');
    Route::post('/store/saveBuy', 'StoreController@postSaveBuy');
    Route::post('/store/saveSale', 'StoreController@postSaveSale');
    Route::post('/store/saveDelivery', 'StoreController@postSaveDelivery');
    Route::post('/store/saveRefund', 'StoreController@postSaveRefund');
    Route::get('/store/buyHistoric', 'StoreController@buyHistoric');
    Route::get('/store/saleHistoric', 'StoreController@saleHistoric');
    Route::get('/store/deliveryHistoric', 'StoreController@deliveryHistoric');
    Route::get('/store/refundHistoric', 'StoreController@refundHistoric');
    Route::post('/store/getDetailButAjax', 'StoreController@getDetailBuyAjax');
    Route::post('/store/getDetailSaleAjax', 'StoreController@getDetailSaleAjax');
    Route::post('/store/getDetailDeliveryAjax', 'StoreController@getDetailDeliveryAjax');
    Route::post('/store/getDetailRefundAjax', 'StoreController@getDetailRefundAjax');

    Route::get('/storedetail', 'StoreDetailController@index');
    Route::get('/storedetail/saleProducts', 'StoreDetailController@saleProducts');
    Route::get('/storedetail/findTypeAheadSale', 'StoreDetailController@findTypeheadSale');
    Route::post('/storedetail/saveSale', 'StoreDetailController@postSaveSaledetail');
    Route::get('/storedetail/saleHistoric', 'StoreDetailController@saleHistoric');

});
