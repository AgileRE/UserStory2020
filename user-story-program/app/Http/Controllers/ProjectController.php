<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Firestore\FirestoreClient;

class ProjectController extends Controller
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
      // Create the Cloud Firestore client
      $db = new FirestoreClient([
          'projectId' => 'userstory-b84d4',
      ]);
      //ambil data
      $project = $db->collection('projects')->documents();
      return view ('project.index',compact('project'));
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
    public function store(Request $request)
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
      # [START fs_add_doc_data_with_auto_id]
      $data = [
          'name' => $request->name,
          'description' => $request->description
      ];
      $addedDocRef = $db->collection('projects')->add($data);
      // dd('Added document with ID:'.$addedDocRef->id());
      return redirect()->route('project.show',['id'=>$addedDocRef->id()])->with(['success'=>'Project berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id)
    {
        // Create the Cloud Firestore client
        $db = new FirestoreClient([
            'projectId' => 'userstory-b84d4',
        ]);
        # [START fs_get_document]
        $project = $db->collection('projects')->document($project_id)->snapshot();
        $feature = $db->collection('projects')->document($project_id)->collection('userStories')->documents();
        // dd($project);
        return view ('project.show',compact('project','feature'));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
