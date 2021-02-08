<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Pilihan;

class SoalController extends Controller
{
    public function get_soal(Request $request){
        if(isset($request->id)){
            $soal = Soal::where('id', $request->id)->first();
            $pil = Pilihan::where('id_soal', $soal->id)->get();
            $soal->pilihan = $pil;
        }

        else{
            $soal = Soal::all();
            foreach ($soal as $s){
                $pil = Pilihan::where('id_soal', $s->id)->get();
                $s->pilihan = $pil;
            }
        }

    	return $soal;
    }

    public function add(Request $request){
        $status = array();

    	$id = Soal::insertGetId([
            'soal' => $request->soal
        ]);

        $pilihan = Pilihan::insert([
        	[
        		'pilihan' => $request->a,
        		'id_soal' => $id,
        		'is_benar' => $request->benar == 0 ? '1' : '0',
        	],
        	[
        		'pilihan' => $request->b,
        		'id_soal' => $id,
        		'is_benar' => $request->benar == 1 ? '1' : '0',
        	],
        	[
        		'pilihan' => $request->c,
        		'id_soal' => $id,
        		'is_benar' => $request->benar == 2 ? '1' : '0',
        	],
        	[
        		'pilihan' => $request->d,
        		'id_soal' => $id,
        		'is_benar' => $request->benar == 3 ? '1' : '0',
        	],
        	[
        		'pilihan' => $request->e,
        		'id_soal' => $id,
        		'is_benar' => $request->benar == 4 ? '1' : '0',
        	],
        ]);

        $status["status"] = !is_null($id) && $pilihan == 1 ? 'success' : 'failed';
        return $status;
    }

    public function edit(Request $request){
        $list_pilihan=array($request->a, $request->b, $request->c, $request->d, $request->e);
        $status = array();

    	$soal = Soal::find($request->id);
    	$soal->soal = $request->soal;
		$status_soal = $soal->save();

		$pilihan = Pilihan::where('id_soal', $request->id)->get();
        for ($i = 0; $i < count($pilihan); $i++) {
            $edit = Pilihan::find($pilihan[$i]->id);
            $edit->pilihan = $list_pilihan[$i];
            $edit->is_benar = $request->benar == $i ? '1' : '0';
            $edit->save();
        }

        $status["status"] = $status_soal == 1 ? 'success' : 'failed';
        return $status;
    }

    public function delete(Request $request){
        $status = array();
        $status_delete = Soal::where('id', $request->id)->delete();
        
        $status["status"] = $status_delete == 1 ? 'success' : 'failed';
        return $status;
    }
}
