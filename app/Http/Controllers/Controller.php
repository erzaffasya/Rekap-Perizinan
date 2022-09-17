<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboardPerBulan($query)
    {
        $data = [
            'January' => 0,
            'February' => 0,
            'March' => 0,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 0,
            'August' => 0,
            'September' => 0,
            'October' => 0,
            'November' => 0,
            'December' => 0,
        ];
        foreach ($query as $item) {
            if ($item->bulan == 'January') {
                $data['January'] = +$item->jumlah;
            }
            if ($item->bulan == 'February') {
                $data['February'] = +$item->jumlah;
            }
            if ($item->bulan == 'March') {
                $data['March'] = +$item->jumlah;
            }
            if ($item->bulan == 'April') {
                $data['April'] = +$item->jumlah;
            }
            if ($item->bulan == 'May') {
                $data['May'] = +$item->jumlah;
            }
            if ($item->bulan == 'June') {
                $data['June'] = +$item->jumlah;
            }
            if ($item->bulan == 'July') {
                $data['July'] = +$item->jumlah;
            }
            if ($item->bulan == 'August') {
                $data['August'] = +$item->jumlah;
            }
            if ($item->bulan == 'September') {
                $data['September'] = +$item->jumlah;
            }
            if ($item->bulan == 'October') {
                $data['October'] = +$item->jumlah;
            }
            if ($item->bulan == 'November') {
                $data['November'] = +$item->jumlah;
            }
            if ($item->bulan == 'December') {
                $data['December'] = +$item->jumlah;
            }
        }
        return array_values($data);
    }

    public function PerBulan($query)
    {
        $data = null;
        foreach ($query as $item) {
            if ($item->bulan == 'January') {
                $data['January'] = $item->jumlah;
            }
            if ($item->bulan == 'February') {
                $data['February'] = $item->jumlah;
            }
            if ($item->bulan == 'March') {
                $data['March'] = $item->jumlah;
            }
            if ($item->bulan == 'April') {
                $data['April'] = $item->jumlah;
            }
            if ($item->bulan == 'May') {
                $data['May'] = $item->jumlah;
            }
            if ($item->bulan == 'June') {
                $data['June'] = $item->jumlah;
            }
            if ($item->bulan == 'July') {
                $data['July'] = $item->jumlah;
            }
            if ($item->bulan == 'August') {
                $data['August'] = $item->jumlah;
            }
            if ($item->bulan == 'September') {
                $data['September'] = $item->jumlah;
            }
            if ($item->bulan == 'October') {
                $data['October'] = $item->jumlah;
            }
            if ($item->bulan == 'November') {
                $data['November'] = $item->jumlah;
            }
            if ($item->bulan == 'December') {
                $data['December'] = $item->jumlah;
            }
        }
        return $data;
    }
}
