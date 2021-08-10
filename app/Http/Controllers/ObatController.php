<?php

namespace App\Http\Controllers;
use DB;
use Validator;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Obat;


class ObatController extends Controller
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
                 'kode_obat' => 'required',
                 'nama_obat' => 'required',
                 'harga_obat' => 'required',
                 'sisa_obat' => 'required',
                 'tgl_kadarluarsa'=>'required'

                ]);

                if($validator->fails()){
                    return response()->default(422, 'Validation errors', $validator->errors());
                }else{

                    DB::table('obat')->insert([
                    'kode_obat' => $request->kode_obat,
                    'nama_obat' => $request->nama_obat,
                    'harga_obat' => $request->harga_obat,
                    'sisa_obat' => $request->sisa_obat,
                    'tgl_kadarluarsa' => $request->tgl_kadarluarsa

                    ]);
                }

                return response()->default(200, 'Supplier created successfully!');
                        
        } catch (Exception $e) {
                $e->getMessage();
        }  
    }

    public function update(Request $request , $id){

        try {
                    
            $update = DB::table('obat')
            ->where('id', $id)
            ->first();

            $update = DB::table('obat')
                ->where('id', $id)
                ->update([
                    'kode_obat' => $request->kode_obat,
                    'nama_obat' => $request->nama_obat,
                    'harga_obat' => $request->harga_obat,
                    'sisa_obat' => $request->sisa_obat,
                    'tgl_kadarluarsa' => $request->tgl_kadarluarsa
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
        $data = DB::table('obat')
                     ->where('id', $id)
                    ->first();

        if(!empty($data)){
            return response()->default(200, 'Data Found!', $data);
        }

        return response()->default(500, 'Internal Server Error!', []);
    }


    public function delete($id)
    {
        $obat = Obat::find($id);
        if(!empty($obat)){
            $obat = $obat->delete();

            return response()->default(200, 'Data deleted successfully!', []);
        }

        return response()->default(500, 'Internal Server Error!', []);
    }

   


}
