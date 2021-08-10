<?php

namespace App\Http\Controllers;
use DB;
use Validator;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Apotek;


class ApotekerController extends Controller
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

            $data = DB::table('apoteker')
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
                 'kode_apoteker' => 'required',
                 'nama_apoteker' => 'required',
                 'tgl_lahir'=>'required'

                ]);

                if($validator->fails()){
                    return response()->default(422, 'Validation errors', $validator->errors());
                }else{

                    DB::table('apoteker')->insert([
                    'kode_apoteker' => $request->kode_apoteker,
                    'nama_apoteker' => $request->nama_apoteker,
                    'tgl_lahir' => $request->tgl_lahir

                    ]);
                }

                return response()->default(200, 'Apoteker created successfully!');
                        
        } catch (Exception $e) {
                $e->getMessage();
        }  
    }

    public function update(Request $request , $id){

        try {
                    
            $update = DB::table('apoteker')
            ->where('id', $id)
            ->first();

            $update = DB::table('apoteker')
                ->where('id', $id)
                ->update([
                    'kode_apoteker' => $request->kode_apoteker,
                    'nama_apoteker' => $request->nama_apoteker,
                    'tgl_lahir' => $request->tgl_lahir
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
        $data = DB::table('apoteker')
                     ->where('id', $id)
                    ->first();

        if(!empty($data)){
            return response()->default(200, 'Data Found!', $data);
        }

        return response()->default(500, 'Internal Server Error!', []);
    }


    public function delete($id)
    {
        $apoteker = Apotek::find($id);
        if(!empty($apoteker)){
            $apoteker = $apoteker->delete();

            return response()->default(200, 'Data deleted successfully!', []);
        }

        return response()->default(500, 'Internal Server Error!', []);
    }

   


}
