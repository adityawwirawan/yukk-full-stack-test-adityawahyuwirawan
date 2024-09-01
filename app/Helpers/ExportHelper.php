<?php

namespace App\Helpers;

use App\Exports\DataExport;
use Illuminate\Support\Facades\Auth;

class ExportHelper
{
    public static function prepareReport($datas)
    {
        $response = [];
        $header = [
            'Kode Transaksi',
            'Tanggal Transaksi',
            'Tipe',
            'Keterangan',
            'Amount'
        ];
        array_push($response, $header);

        foreach ($datas as $data) {
            array_push($response, [
                $data->transaction_code,
                $data->created_at,
                $data->type,
                $data->remark,
                $data->amount,
             ]);
        }

        return new DataExport($response);
    }

}
