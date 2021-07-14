<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reader;
use App\Models\Meter;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Reader::all();
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_meter'=>'required',
            'battery_level'=>'required',
            'load_level'=>'required'
            
        ]);
        if (Meter::where('num_meter', '=', $request->num_meter)->exists()) {

            $reader = new Reader();
            $reader->num_meter = $request->num_meter;
            $reader->load_level = $request->load_level;
            $reader->battery_level = $request->battery_level;
            $reader->load_date = now();
            $meter = DB::table('meters')->where('num_meter', $request->num_meter)->get();
            if(!$meter[0]->instalation_date){
                DB::table('meters')
                    ->where('num_meter', $request->num_meter)
                    ->update(['instalation_date' => $reader->load_date]);
            }
            return $reader->save();
         }
        
        return  response()->json(['errors' => ['invalid_meter'=>'No existe numero de Medidor']], 404);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Reader::find($id);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reader = Reader::findOrFail($id);
        $reader->update($request->all());

        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reader::find($id)->delete();

        return 204;
    }
}
