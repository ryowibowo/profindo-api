<?php

namespace App\Http\Controllers;
use DB;
use Validator;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Transaksi;


class TransaksiController extends Controller
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

            $data = DB::table('trans_obat')
                ->select('trans_obat.id',
                    'trans_obat.trans_id', 
                    'obat.nama_obat', 'apoteker.nama_apoteker',
                    'trans_obat.jumlah_jual',
                    'trans_obat.tgl_beli'
                    )
                ->join('obat', 'obat.kode_obat', '=', 'trans_obat.kode_obat')
                ->join('apoteker', 'apoteker.kode_apoteker', '=', 'trans_obat.kode_apoteker')
                ->orderBy('trans_id')
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

    public function add(Request $request){

        try {      
                $validator = Validator::make($request->all(),[
                 'trans_id' => 'required',
                 'kode_obat' => 'required',
                 'kode_apoteker' => 'required',
                 'tgl_beli' => 'required',
                 'jumlah_jual'=>'required'

                ]);

                if($validator->fails()){
                    return response()->default(422, 'Validation errors', $validator->errors());
                }else{

                    DB::table('trans_obat')->insert([
                        'trans_id' => $request->trans_id,
                        'kode_obat' => $request->kode_obat,
                        'kode_apoteker' => $request->kode_apoteker,
                        'jumlah_jual' => $request->jumlah_jual,
                        'tgl_beli' => $request->tgl_beli
                    ]);
                }

                return response()->default(200, 'Apoteker created successfully!');
                        
        } catch (Exception $e) {
                $e->getMessage();
        }  
    }

    public function update(Request $request , $id){

        try {
                    
            $update = DB::table('trans_obat')
            ->where('id', $id)
            ->first();

            $update = DB::table('trans_obat')
                ->where('id', $id)
                ->update([
                    'trans_id' => $request->trans_id,
                    'kode_obat' => $request->kode_obat,
                    'kode_apoteker' => $request->kode_apoteker,
                    'jumlah_jual' => $request->jumlah_jual,
                    'tgl_beli' => $request->tgl_beli
            ]);
            
            if (!$update) {
                return response()->default(404, 'Data not found', []);
            }else{
                return response()->default(200, 'Data updated successfully!', []);
            }

        } catch (Exception $e) {
                 $e->getMessage();
            
        }  
    }

    public function detail($id)
    {   
        $data = DB::table('trans_obat')
                     ->where('id', $id)
                    ->first();

        if(!empty($data)){
            return response()->default(200, 'Data Found!', $data);
        }

        return response()->default(500, 'Internal Server Error!', []);
    }


    public function delete($id)
    {
        $trans = Transaksi::find($id);
        if(!empty($trans)){
            $trans = $trans->delete();

            return response()->default(200, 'Data deleted successfully!', []);
        }

        return response()->default(500, 'Internal Server Error!', []);
    }

   


}
