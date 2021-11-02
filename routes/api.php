<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// invoices
Route::group(['prefix' => 'invoices'], function () {

    Route::get('/', [InvoiceController::class, 'getInvoices'])->name('listOfInvoices');
    Route::post('/', [InvoiceController::class, 'createInvoice'])->name('createAnInvoice');
});
