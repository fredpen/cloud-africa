<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// invoices
Route::group(['prefix' => 'invoices', 'middleware' => 'isServiceTransitioned'], function () {

    /** samples of a resource that has been  switched to the new service */
    Route::get('/', [InvoiceController::class, 'getInvoices'])->name('listOfInvoices');
    Route::post('/', [InvoiceController::class, 'createInvoice'])->name('createAnInvoice');

    /** samples of a resource that is not switched to the new service
        one with route name and the other without
     */
    Route::get('unswitched', [InvoiceController::class, 'unswitched'])->name('unswitched');
    Route::get('unswitched-two', [InvoiceController::class, 'unswitched']);
});
