<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Facility;
use Illuminate\Http\Request;
use DB;
use Excel;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        return view('cms.staff', [
          'staff' => $this->staff(),
        ]);
    }

    /**
     * Return the staff as json.
     *
     * @return \Illuminate\Database\Eloquent\Collection  $staff
     */
    public function staff()
    {
      return Staff::all();
                  // ->map(function ($staff) {
                  //   return $this->attachPicture($staff);
                  // });
    }
    
    /**
     * Display the form to add resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('cms.forms.staff-form', [
        'breadcrumb_active' => 'Create New Staff',
        'breadcrumb_past' => 'Staff',
        'breadcrumb_past_url' => route('staff.index'), 
        'facilities' => Facility::all(),
      ]);
    }
    
    public function edit(Staff $staff) {
      // $staff = $this->attachPicture($staff);
      
      return view('cms.forms.staff-form', [
        'breadcrumb_active' => 'Update Staff',
        'breadcrumb_past' => 'Staff',
        'breadcrumb_past_url' => route('staff.index'), 
        'staff' => $staff,
        'facilities' => Facility::all(),
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
      $staff = Staff::create($request->all());
  		// if ($staff && $request->hasFile('picture')) {
  		// 	$this->updatePicture($request, $staff);
  		// }
      return redirect()->route('staff.create')
                       ->with('message', 'Staff created successfully');
    }

    /**
     * Get the validation rules
     *
     * @return array
     */
    private function rules(string $id = null) {
      return [
        'facility_id' => 'required|integer',
        'first_name'=> 'required', 
        'last_name'=> 'required', 
        'phone_number'=> 'required',
        'device_sn'=> 'nullable', 
        'device_imei'=> 'nullable', 
        'status'=> 'nullable|boolean',
        'description'=> 'nullable',
        'type'=> 'required',
        'picture' => 'nullable|file|image|max:2048',
      ];
    }

    /**
     * Get the validation messages
     *
     * @return array
     */
    private function messages() {
      return [
        'name.unique' => 'A staff with same name exists',
      ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, $this->rules($id), $this->messages());
      return $staff = Staff::updateOrCreate(compact('id'), $request->all());
      // return $this->attachPicture($staff);
    }
    
    public function updatePicture(Request $request, Staff $staff)
    {
      $this->validate($request, ['picture' => 'nullable|file|image|max:2048',]);
      $staff->clearMediaCollection('staff_pictures');
      $extension = $request->file('picture')->getClientOriginalExtension();
      $fileName = uniqid() . $extension;
      $staff->addMediaFromRequest('picture')
              ->usingFileName($fileName)->toMediaCollection('staff_pictures');
      return $this->attachPicture($staff)->picture;
    }
    
    /**
     * Attach Picture to Staff.
     *
     * @return \App\Staff  $staff
     */
    private function attachPicture($staff) {
  
      if($staff->hasMedia('staff_pictures')) {
        $staff->picture = $staff->getFirstMediaUrl('staff_pictures');
      } 
      
      return $staff;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return boolean
     */
    public function destroy(Staff $staff)
    {
      $id = $staff->id;
      $staff->delete();
      
      return $id;
    }



    public function importExcel(Request $request)
      {
        // $facility_name=$request->get('facility_id');

          if($request->hasFile('import_file')){
               Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                  foreach ($reader->toArray() as $key => $row) {
                        $data['first_name'] = $row['first_name'];
                        $data['last_name']=$row['last_name']; 
                        $data['phone_number']=$row['phone_number']; 
                        $data['device_sn']=$row['device_sn']; 
                        $data['device_imei']=$row['device_imei']; 
                        $data['status']=$row['status']; 
                        $data['description']=$row['description']; 
                        $data['type']=$row['type'];
                        $data['facility_id'] =$row['facility_name'];
              if(!empty($data)) {
                         DB::table('staff')->insert($data);
                      }
                  }
              });
          }

          return redirect()->route('staff.create')
                           ->with('message', 'Region created successfully');
      }

      public function getIpc(){
      return  Staff::where('type', IPC)->get();
      }


}
