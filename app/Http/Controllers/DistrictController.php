<?php

namespace App\Http\Controllers;

use App\District;
use App\Region;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        return view('cms.districts', [
          'districts' => $this->districts(),
        ]);
    }

    /**
     * Return the districts as json.
     *
     * @return \Illuminate\Database\Eloquent\Collection  $districts
     */
    public function districts()
    {
      return District::all();
                    // ->map(function ($district) {
                    //   return $this->attachPicture($district);
                    // });
    }
    
    /**
     * Display the form to add resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(){
      return view('cms.forms.district-form', [
        'breadcrumb_active' => 'Create New District',
        'breadcrumb_past' => 'Districts',
        'breadcrumb_past_url' => route('districts.index'), 
        'regions' => Region::all(),
      ]);
    }
    
    public function edit(District $district) {
      // $district = $this->attachPicture($district);
      
      return view('cms.forms.district-form', [
        'breadcrumb_active' => 'Update District',
        'breadcrumb_past' => 'Districts',
        'breadcrumb_past_url' => route('districts.index'), 
        'district' => $district,
        'regions' => Region::all(),
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
      $district = District::create($request->all());
  		// if ($district && $request->hasFile('picture')) {
  		// 	$this->updatePicture($request, $district);
  		// }
      return redirect()->route('districts.create')
                       ->with('message', 'District created successfully');
    }

    /**
     * Get the validation rules
     *
     * @return array
     */
    private function rules(string $id = null) {
      return [
        'name' => 'required',
        'region_id' => 'required|integer',
      ];
    }

    /**
     * Get the validation messages
     *
     * @return array
     */
    private function messages() {
      return [
        'name.unique' => 'A district with same name exists',
      ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, $this->rules($id), $this->messages());
      return $district = District::updateOrCreate(compact('id'), $request->all());
      // return $this->attachPicture($district);
    }
    
    public function updatePicture(Request $request, District $district)
    {
      $this->validate($request, ['picture' => 'nullable|file|image|max:2048',]);
      $district->clearMediaCollection('program_pictures');
      $extension = $request->file('picture')->getClientOriginalExtension();
      $fileName = uniqid() . $extension;
      $district->addMediaFromRequest('picture')
              ->usingFileName($fileName)->toMediaCollection('program_pictures');
      return $this->attachPicture($district)->picture;
    }
    
    /**
     * Attach Picture to District.
     *
     * @return \App\District  $district
     */
    private function attachPicture($district) {
  
      if($district->hasMedia('program_pictures')) {
        $district->picture = $district->getFirstMediaUrl('program_pictures');
      } else {
        $district->picture = asset('images/programsbanner.png');
      }
      
      return $district;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return boolean
     */
    public function destroy(District $district)
    {
      $id = $district->id;
      $district->delete();
      
      return $id;
    }
}
