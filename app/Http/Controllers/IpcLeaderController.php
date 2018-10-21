<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class IpcLeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        return view('cms.ipcLeaders', [
          'ipcLeaders' => $this->ipcLeaders(),
        ]);
    }

    /**
     * Return the ipcLeaders as json.
     *
     * @return \Illuminate\Database\Eloquent\Collection  $ipcLeaders
     */
    public function ipcLeaders()
    {
      return User::ipcLeaders()
                    ->map(function ($ipcLeader) {
                      // return $ipcLeader;
                      return $this->attachPicture($ipcLeader);
                    });
    }
    
    /**
     * Display the form to add resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('cms.forms.ipc_leader-form', [
        'breadcrumb_active' => 'Create New IpcLeader',
        'breadcrumb_past' => 'IpcLeaders',
        'breadcrumb_past_url' => route('ipcLeaders.index'), 
      ]);
    }
    
    public function edit(User $ipcLeader) {
      $ipcLeader = $this->attachPicture($ipcLeader);
      
      return view('cms.forms.ipc_leader-form', [
        'breadcrumb_active' => 'Update IpcLeader',
        'breadcrumb_past' => 'IpcLeaders',
        'breadcrumb_past_url' => route('ipcLeaders.index'), 
        'ipcLeader' => $ipcLeader,
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

      $role = Role::where('name', 'ipc_leader')->first();
      $request->merge(['password' => bcrypt(strtoupper($request->last_name))]);
      $ipcLeader = $role->users()->create($request->all());
     
  		if ($ipcLeader && $request->hasFile('picture')) {
  		$this->updatePicture($request, $ipcLeader);
  		 }
      return redirect()->route('ipcLeaders.create')
                       ->with('message', 'IpcLeader created successfully');
    }

    /**
     * Get the validation rules
     *
     * @return array
     */
    private function rules(string $id = null) {
      return [
        'first_name'=> 'required', 
        'last_name'=> 'required', 
        'email'=> 'required|unique:users',
        'phone_number'=> 'required|unique:users',
        'device_sn'=> 'nullable', 
        'device_imei'=> 'nullable', 
        'description'=> 'nullable',
        'status'=> 'nullable|boolean',
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
        'name.unique' => 'An ipcLeader with same name exists',
      ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $ipcLeader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, $this->rules($id), $this->messages());
      $ipcLeader = User::updateOrCreate(compact('id'), $request->all());
      //return $ipcLeader;
       return $this->attachPicture($ipcLeader);
    }
    
    public function updatePicture(Request $request, User $ipcLeader)
    {
      $this->validate($request, ['picture' => 'nullable|file|image|max:2048',]);
      $ipcLeader->clearMediaCollection('ipc_leader_pictures');
      $extension = $request->file('picture')->getClientOriginalExtension();
      $fileName = uniqid() . $extension;
      $ipcLeader->addMediaFromRequest('picture')
                ->usingFileName($fileName)->toMediaCollection('ipc_leader_pictures');
      return $this->attachPicture($ipcLeader)->picture;
    }
    
    /**
     * Attach Picture to User.
     *
     * @return \App\User  $ipcLeader
     */
    private function attachPicture($ipcLeader) {
    
      if($ipcLeader->hasMedia('ipc_leader_pictures')) {
        $ipcLeader->picture = $ipcLeader->getFirstMediaUrl('ipc_leader_pictures');
      } else {
        $ipcLeader->picture = asset('images/avatar.png');
      }
      
      return $ipcLeader;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $ipcLeader
     * @return boolean
     */
    public function destroy(User $ipcLeader)
    {
      $id = $ipcLeader->id;
      $ipcLeader->delete();
      
      return $id;
    }
}
