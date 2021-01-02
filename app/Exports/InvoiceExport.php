<?php

namespace App\Exports;

use App\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      //  return invoices::all();
        return invoices::select('invoice_number','product','status','Value_Status','Payment_Date','note','invoice_Date','created_at')->get();
    }
}
