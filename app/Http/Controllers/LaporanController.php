<?php

namespace App\Http\Controllers;
use DB;
use Validator;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;


class LaporanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function get()
    {
        try {

            $data = DB::table('obat')
                ->select('obat.kode_obat',
                    'obat.nama_obat',
                    'obat.sisa_obat', 
                    DB::raw('SUM(trans_obat.jumlah_jual) AS total_jual'),
                    )
                ->join('trans_obat', 'trans_obat.kode_obat', '=', 'obat.kode_obat')
                ->groupBy('obat.kode_obat',
                    'obat.nama_obat',
                    'obat.sisa_obat'
                    )
                ->get();
             if (!$data) {
                return response()->default(404, 'Data not found', []);
            } else {
                return response()->default(200, 'OK', $data);
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }



}
