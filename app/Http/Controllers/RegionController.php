<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Excel;
use DB;
use App\Exports\RegionsExport;
use App\Exports\RegionsInport;



class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function index()
    {   
        
        return view('cms.regions', [
          'regions' => $this->regions(),
        ]);
    }

    /**
     * Return the regions as json.
     *
     * @return \Illuminate\Database\Eloquent\Collection  $regions
     */
    public function regions()
    {
      return Region::all();
    }
    
    /**
     * Display the form to add resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('cms.forms.region-form', [
        'breadcrumb_active' => 'Create New Region',
        'breadcrumb_past' => 'Regions',
        'breadcrumb_past_url' => route('regions.index'), 
      ]);
    }
    
    public function edit(Region $region) {
      // $region = $this->attachPicture($region);
      
      return view('cms.forms.region-form', [
        'breadcrumb_active' => 'Update Region',
        'breadcrumb_past' => 'Regions',
        'breadcrumb_past_url' => route('regions.index'), 
        'region' => $region,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, $this->rules(), $this->messages());
      $region = Region::create($request->all());
      return redirect()->route('regions.create')
                       ->with('message', 'Region created successfully');
    }

    /**
     * Get the validation rules
     *
     * @return array
     */
    private function rules(string $id = null) {
      return [
        'name' => 'required',
      ];
    }

    /**
     * Get the validation messages
     *
     * @return array
     */
    private function messages() {
      return [
        'name.unique' => 'A region with same name exists',
      ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, $this->rules($id), $this->messages());
      $region = Region::updateOrCreate(compact('id'), $request->all());
      return $region;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return boolean
     */
    public function destroy(Region $region)
    {
      $id = $region->id;
      $region->delete();
      
      return $id;
    }
    public function export()
    {
        return Excel::download(new RegionsExport, 'regions.xlsx');
    }
    public function importExcel(Request $request)
    {

        if($request->hasFile('import_file')){
                                 // Region::create(['name' => 'erick']);

            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['name'] = $row['name'];

                    if(!empty($data)) {
                       DB::table('regions')->insert($data);
                    }
                }
            });
        }

        return redirect()->route('regions.create')
                         ->with('message', 'Region created successfully');

        // Session::put('success', 'Youe file successfully import in database!!!');

        // return back();
    }
}
