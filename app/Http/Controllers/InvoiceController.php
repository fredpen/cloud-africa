<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $tax_percentage = 1.9;

    public function getInvoices(Request $request)
    {
        $invoices = Invoice::all();
        if (!$invoices->count()) {
            return $this->notFound("You do not have any invoice in the system at the moment");
        }

        $response_data['invoices'] = $invoices;
        $response_data['invoice_count'] = count($invoices);
        $response_data['total_invoice_amount'] = $invoices->sum('total_amount');

        return $this->sendSuccess($response_data);
    }

    public function createInvoice(Request $request)
    {
        // validate payload
        $request->validate([
            'customer_name' => 'bail|required|string|min:4',
            'customer_address' => 'bail|required|string|min:4',
            'amount' => 'bail|required|numeric'
        ]);

        // build invoice object
        $request_data = $request->only("customer_name", "customer_address", "amount");
        $request_data['tax'] = ($request->amount * $this->tax_percentage) / 100;
        $request_data['total_amount'] = $request_data['tax'] + $request->amount;

        // create invoice
        $invoice_created = Invoice::create($request_data);
        if (!$invoice_created) {
            return $this->serverError("Could not create invoice at the moment");
        }

        return $this->sendSuccess([]);
    }

    public function unswitched()
    {
       return $this->sendSuccess([]);
    }

}
