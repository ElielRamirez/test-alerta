<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meter;
use Illuminate\Validation\ValidationException;
class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Meter::all();
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
            'num_meter'=>'required|unique:meters',
            'description'=>'required',
            'version'=>'required',
            'type'=>'required|in:mni,mna,mnt', //MNI, MNA, MNT
            
        ]);
        $meter = new Meter();
        $meter->num_meter = $request->num_meter;
        $meter->description = $request->description;
        $meter->version = $request->version;
        $meter->type = $request->type;
        return $meter->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Meter::find($id);
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
        $validated = $request->validate([
            'description'=>'required',
            'version'=>'required',
            'type'=>'required|in:mni,mna,mnt', //MNI, MNA, MNT
            
        ]);
        $reader = Meter::find('num_meter','=',$id);

        $reader->description = $request->description;
        $reader->version = $request->version;
        $reader->type = $request->type;

        

        return $reader->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meter::where('num_meter','=',$id)->delete();

        return 204;
    }
}
