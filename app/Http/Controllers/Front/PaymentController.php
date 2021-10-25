<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class PaymentController extends Controller
{
    public function index()
    {
        return view('front.page.user.payments');
    }

    public function index_data ()
    {
        $rows = CompanyPayment::select(['company_payments.*']);
        return DataTables::eloquent($rows)
            ->editColumn('amount', function ($row) {

                return $row->amount . ' ' . $row->companies->currency;

            })
            ->toJson();
    }
}
