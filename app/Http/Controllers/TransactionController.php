<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        $datas = Transactions::where('user_by', Auth::user()->email)->paginate(10);

        return view('transaction', ['datas' => $datas]);
    }

    public function tambahTransaksi()
    {
        return view('add-transaction');
    }

    public function tambahTransaksiProses(Request $request)
    {
        $topup_total = Transactions::selectRaw('sum(amount) as amount')->where('type', 'topup')->where('user_by', Auth::user()->email)->first();
        $transaction_total = Transactions::selectRaw('sum(amount) as amount')->where('type', 'transaksi')->where('user_by', Auth::user()->email)->first();
        $saldo = $topup_total['amount'] - $transaction_total['amount'];

        $transactions_code = strtoupper(substr($request->tipe, 0, 2).time().uniqid());
        $amount = Str::remove(',', $request->amount);

        if($request->tipe == 'transaksi' && ($amount > $saldo)){
            return redirect()->route('transaksi')->with('failed', 'Transaksi gagal!! Saldo anda tidak mencukupi.');
        }else if($amount == 0){
            return redirect()->route('transaksi')->with('failed', 'Transaksi gagal!! Amount tidak boleh 0.');
        }


        $transactions = new Transactions();
        $transactions->transaction_code = $transactions_code;
        $transactions->type = $request->tipe;
        $transactions->amount = $amount;
        $transactions->file = (isset($file_name)) ? $file_name:'';
        $transactions->remark = $request->keterangan;
        $transactions->created_at = now();
        $transactions->user_by = Auth::user()->email;
        $transactions->save();

        return redirect()->route('transaksi')->with('success', 'Transaksi Berhasil!!');

    }
}
