<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ExportHelper;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $value_from_filter = isset($request) ? $request->all():[];

        $datas = $this->getData($request, 'index');

        $topup_total = Transactions::selectRaw('sum(amount) as amount')->where('type', 'topup')->where('user_by', Auth::user()->email)->first();
        $transaction_total = Transactions::selectRaw('sum(amount) as amount')->where('type', 'transaksi')->where('user_by', Auth::user()->email)->first();
        $saldo = $topup_total['amount'] - $transaction_total['amount'];

        return view('history', ['datas' => $datas, 'saldo' => $saldo, 'value_from_filter' => $value_from_filter]);
    }

    public function export(Request $request)
    {
        $datas = $this->getData($request, 'report');

        $export = ExportHelper::prepareReport($datas);
        return Excel::download($export, 'RiwayatSaldo-' . Carbon::now()->format('Y-m-d') . '.xlsx');
    }

    public function getData($request, $calltype)
    {
        $search =  $request->input('search');
        $type =  $request->input('tipe');
        $datefrom =  $request->input('datefrom');
        $dateto =  $request->input('dateto');

        $query = Transactions::where('user_by', Auth::user()->email);

        if (!empty($search)) {
            $datas = $query->where(function ($query) use ($search) {
                    $query->where('transaction_code', 'LIKE', '%' . $search . '%')
                        ->orWhere('remark', 'LIKE', '%' . $search . '%');
                });
        }

        if (!empty($type)) {
            $datas = $query->where('type', $type);
        }

        if(!empty($datefrom) && !empty($dateto)){
            $arrDate = [$datefrom->format('Y-m-d'), $dateto->format('Y-m-d')];
            $datas = $query->whereBetween('created_at', $arrDate);
        }

        if($calltype == 'report'){
            $datas = $query->get();
        }else{
            $datas = $query->paginate(10);
        }

        return $datas;
    }
}
