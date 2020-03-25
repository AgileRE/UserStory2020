<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Firestore\FirestoreClient;

class ScenarioController extends Controller
{
    public function validator($data, $rules, $message){
      return Validator::make($data, $rules, $message);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id, $feature_id)
    {
      //validasi
      $message = [
        'name.required' => 'Anda belum mengisi nama project',
        'given.*.required' =>  'Ada skenario given yang belum diisi',
        'when.*.required' =>  'Ada skenario when yang belum diisi',
        'then.*.required' =>  'Ada skenario then yang belum diisi',
       ];
       $rules = [
          'name' => 'required',
       ];
       if($request->has('given')){
           $nbr = count($request->given) - 1;
           foreach(range(0, $nbr) as $index) {
             $rules[ 'given.' . $index] = 'required';
           }
       }
       if($request->has('when')){
           $nbr = count($request->given) - 1;
           foreach(range(0, $nbr) as $index) {
             $rules[ 'when.' . $index] = 'required';
           }
       }
       if($request->has('then')){
           $nbr = count($request->given) - 1;
           foreach(range(0, $nbr) as $index) {
             $rules[ 'then.' . $index] = 'required';
           }
       }
       $validator = $this->validator($request->all(), $rules, $message);
       if ($validator->fails()){
           return Redirect::back()->withInput()->with(['error' => $validator->errors()->first()]);
       }
       //proses simpan
      $db = new FirestoreClient([
      'projectId' => 'userstory-b84d4',
      ]);
      //simpan skenario
      $feature = $db->collection('projects')->document($project_id)->collection('userStories')
                       ->document($feature_id)->snapshot()->data();
      //save Given
      // dd($feature);
      $scenarios =
      [
        'name' => $request->name,
        'given'=>$request->given,
        'when'=>$request->when,
        'then'=>$request->then,
      ];
      array_push($feature['scenarios'],$scenarios);
      // dd($feature['scenarios']);
      $db->collection('projects')->document($project_id)->collection('userStories')->document($feature_id)->set($feature);
      // dd('Added document with ID:'.$addedDocRef->id());
      return redirect()->route('feature.show',['project_id'=>$project_id,'feature_id'=>$feature_id])->with(['success'=>'User Story berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$project_id,$feature_id,$id)
    {
      // dd($request);
      //validasi
      $message = [
        'name.required' => 'Anda belum mengisi nama project',
        'given.*.required' =>  'Ada skenario given yang belum diisi',
        'when.*.required' =>  'Ada skenario when yang belum diisi',
        'then.*.required' =>  'Ada skenario then yang belum diisi',
       ];
       $rules = [
          'name' => 'required',
       ];
       if($request->has('given')){
           $nbr = count($request->given) - 1;
           foreach(range(0, $nbr) as $index) {
             $rules[ 'given.' . $index] = 'required';
           }
       }
       if($request->has('when')){
           $nbr = count($request->given) - 1;
           foreach(range(0, $nbr) as $index) {
             $rules[ 'when.' . $index] = 'required';
           }
       }
       if($request->has('then')){
           $nbr = count($request->given) - 1;
           foreach(range(0, $nbr) as $index) {
             $rules[ 'then.' . $index] = 'required';
           }
       }
       $validator = $this->validator($request->all(), $rules, $message);
       if ($validator->fails()){
           return Redirect::back()->withInput()->with(['error' => $validator->errors()->first()]);
       }
       //proses simpan
      $db = new FirestoreClient([
      'projectId' => 'userstory-b84d4',
      ]);
      //simpan skenario
      $feature = $db->collection('projects')->document($project_id)->collection('userStories')
                       ->document($feature_id)->snapshot()->data();
      //save Given
      // dd($feature);
      $scenarios =
      [
        'name' => $request->name,
        'given'=>$request->given,
        'when'=>$request->when,
        'then'=>$request->then,
      ];
      $feature['scenarios'][$id] = $scenarios;
      $db->collection('projects')->document($project_id)->collection('userStories')->document($feature_id)->set($feature);
      // dd('Added document with ID:'.$addedDocRef->id());
      return redirect()->route('feature.show',['project_id'=>$project_id,'feature_id'=>$feature_id])->with(['success'=>'User Story berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $feature_id, $id)
    {
      //proses simpan
     $db = new FirestoreClient([
     'projectId' => 'userstory-b84d4',
     ]);
     //ambil data
     $feature = $db->collection('projects')->document($project_id)->collection('userStories')
                ->document($feature_id)->snapshot()->data();
     // hapus data
     unset($feature['scenarios'][$id]);
     // dd($feature['scenarios']);
     $db->collection('projects')->document($project_id)->collection('userStories')->document($feature_id)->set($feature);
     // dd('Added document with ID:'.$addedDocRef->id());
     return redirect()->route('feature.show',['project_id'=>$project_id,'feature_id'=>$feature_id])->with(['success'=>'User Story berhasil dihapus']);
    }
}
