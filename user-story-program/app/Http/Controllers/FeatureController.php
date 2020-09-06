<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Firestore\FirestoreClient;

class FeatureController extends Controller
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
    public function store(Request $request, $project_id)
    {
      //validasi
      $message = [
        'name.required' => 'Anda belum mengisi nama user story',
        'role.required' => 'Anda belum mengisi peran user story',
        'description.required' => 'Anda belum mengisi deskripsi user story',
       ];
       $rules = [
          'name' => 'required',
          'role' => 'required',
          'description' => 'required',
       ];
       $validator = $this->validator($request->all(), $rules, $message);
       if ($validator->fails()){
           return Redirect::back()->withInput()->with(['error' => $validator->errors()->first()]);
       }
       //proses simpan
      $db = new FirestoreClient([
      'projectId' => 'userstory-b84d4',
      ]);
      # [START fs_add_doc_data_with_auto_id]
      $data = [
          'name' => $request->name,
          'role' => $request->role,
          'description' => $request->description,
          'scenarios' => [],
      ];
      $save = $db->collection('projects')->document($project_id)->collection('userStories')->add($data);
      // dd('Added document with ID:'.$addedDocRef->id());
      return redirect()->route('feature.show',['project_id'=>$project_id,'feature_id'=>$save->id()])->with(['success'=>'User Story berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id,$feature_id)
    {
      // Create the Cloud Firestore client
      $db = new FirestoreClient([
          'projectId' => 'userstory-b84d4',
      ]);
      # [START fs_get_document]
      $project = $db->collection('projects')->document($project_id)->snapshot();
      $feature = $db->collection('projects')->document($project_id)->collection('userStories')->document($feature_id)->snapshot();
      $command_given = $db->collection('commands')->document(1)->snapshot();
      $command_when = $db->collection('commands')->document(2)->snapshot();
      $command_then = $db->collection('commands')->document(3)->snapshot();
      // dd(count($feature['scenarios'][0]['given']));
      // dd($command_given['command_list']);
      // dd($project);
      return view ('feature.show',compact('project','feature','command_given','command_when','command_then'));
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
    public function update(Request $request, $project_id, $id)
    {
      //validasi
      $message = [
        'name.required' => 'Anda belum mengisi nama project',
        'description.required' => 'Anda belum mengisi deskripsi project',
       ];
       $rules = [
          'name' => 'required',
          'description' => 'required',
       ];
       $validator = $this->validator($request->all(), $rules, $message);
       if ($validator->fails()){
           return Redirect::back()->withInput()->with(['error' => $validator->errors()->first()]);
       }
       //proses simpan
      $db = new FirestoreClient([
      'projectId' => 'userstory-b84d4',
      ]);
      //ambil data
      $feature = $db->collection('projects')->document($project_id)->collection('userStories')
                 ->document($id)->snapshot()->data();
      $feature['name'] = $request->name;
      $feature['role'] = $request->role;
      $feature['description'] = $request->description;
      //simpan data
      $db->collection('projects')->document($project_id)->collection('userStories')->document($id)->set($feature);
      // return
      return redirect()->route('feature.show',['project_id'=>$project_id,'feature_id'=>$id])->with(['success'=>'User Story berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id,$id)
    {
      // Create the Cloud Firestore client
      $db = new FirestoreClient([
          'projectId' => 'userstory-b84d4',
      ]);
      //hapus data
      $feature = $db->collection('projects')->document($project_id)->collection('userStories')->document($id)->delete();
      //return
      return redirect()->route('project.show',['project_id'=>$project_id])->with(['success'=>'User Story berhasil dihapus']);
    }
}
