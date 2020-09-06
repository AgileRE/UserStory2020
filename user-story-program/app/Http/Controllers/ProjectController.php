<?php

namespace App\Http\Controllers;

use Redirect;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
// use Chumper\Zipper\Zipper;

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
      $data = [
          'name' => $request->name,
          'description' => $request->description
      ];
      //simpan data
      $save = $db->collection('projects')->add($data);
      //return
      return redirect()->route('project.show',['project_id'=>$save->id()])->with(['success'=>'Project berhasil dibuat']);
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
        //ambil data
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
      $project = $db->collection('projects')->document($id)->snapshot()->data();
      $project['name'] = $request->name;
      $project['description'] = $request->description;
      //simpan data
      $db->collection('projects')->document($id)->set($project);
      // return
      return redirect()->route('project.show',['project_id'=>$id])->with(['success'=>'Project berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // dd($id);
      // Create the Cloud Firestore client
      $db = new FirestoreClient([
          'projectId' => 'userstory-b84d4',
      ]);
      //hapus data
      $db->collection('projects')->document($id)->delete();
      //return
      return redirect()->route('project.index')->with(['success'=>'Project berhasil dihapus']);
    }

    public function generateUI($id){
      // Create the Cloud Firestore client
      $db = new FirestoreClient([
          'projectId' => 'userstory-b84d4',
      ]);
      //ambil data
      $project = $db->collection('projects')->document($id)->snapshot();
      $features = $db->collection('projects')->document($id)->collection('userStories')->documents();
      //identifikasi properti dari seluruh user story/feature dari projects
      //strukturnya seperti ini
      // $data = [
      //   [
      //     'url' => '',
      //     'form' => [
      //       (isinya form_element)
      //     ],
      //     'form_select' => [
      //       (isinya form_select)
      //     ],
      //     'form_checkbox' => [
      //       (isinya form_checkbox)
      //     ],
      //     'button' => [
      //       [
      //         'name' => '', (0/nama_button)
      //         'url' => '', (0/nama_url) (untuk then yg berisi pindah halaman)
      //         'messsage' => '', (0/isi_pesan) (untuk then yg berisi pesan peringatan)
      //       ],
      //     ],
      //   ],
      // ];
      $data = [];
      foreach($features as $feature){
        for($i=0;$i<count($feature['scenarios']);$i++){
          $index_data = null;
          for($j=0;$j<count($feature['scenarios'][$i]['given']);$j++){
            //cek apakah ada kata2 url dalam command
            if(strpos($feature['scenarios'][$i]['given'][$j]['command'], 'url')){
              //ambil parameter url
              $url = $feature['scenarios'][$i]['given'][$j]['parameter'];
              //cek apakah url udah ada di array
              for($k=0;$k<count($data);$k++) {
                if($data[$k]['url']==$url){
                  $index_data = $k;
                  break;
                }
              }
            }
          }
          if($index_data!==null){
            //jika di cek ada, maka cek isinya
            //cek untuk form_elements
            for($j=0;$j<count($feature['scenarios'][$i]['when']);$j++){
              if(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'form_element')){
                //cek apakah ada form_element yg sama atau tidak di dalam $data
                $form_check = true;
                for($k=0;$k<count($data[$index_data]['form']);$k++) {
                  if($data[$index_data]['form'][$k]==$feature['scenarios'][$i]['when'][$j]['parameter']){
                    $form_check = false;
                    break;
                  }
                }
                //jika form_element belum ada di $data, maka diinputkan
                if($form_check){
                  $form = $feature['scenarios'][$i]['when'][$j]['parameter'];
                  array_push($data[$index_data]['form'],$form);
                }
              }elseif(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'form_select')){
                //cek apakah ada form_element yg sama atau tidak di dalam $data
                $form_check = true;
                for($k=0;$k<count($data[$index_data]['form_select']);$k++) {
                  if($data[$index_data]['form_select'][$k]==$feature['scenarios'][$i]['when'][$j]['parameter']){
                    $form_check = false;
                    break;
                  }
                }
                //jika form_element belum ada di $data, maka diinputkan
                if($form_check){
                  $form = $feature['scenarios'][$i]['when'][$j]['parameter'];
                  array_push($data[$index_data]['form_select'],$form);
                }
              }elseif(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'form_checkbox')){
                //cek apakah ada form_element yg sama atau tidak di dalam $data
                $form_check = true;
                for($k=0;$k<count($data[$index_data]['form_checkbox']);$k++) {
                  if($data[$index_data]['form_checkbox'][$k]==$feature['scenarios'][$i]['when'][$j]['parameter']){
                    $form_check = false;
                    break;
                  }
                }
                //jika form_element belum ada di $data, maka diinputkan
                if($form_check){
                  $form = $feature['scenarios'][$i]['when'][$j]['parameter'];
                  array_push($data[$index_data]['form_checkbox'],$form);
                }
              }
            }
            //cek untuk button
            for($j=0;$j<count($feature['scenarios'][$i]['when']);$j++){
              if(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'button')){
                //cek apakah ada button yg sama atau tidak di dalam $data
                $button_check = true;
                for($k=0;$k<count($data[$index_data]['button']);$k++) {
                  if($data[$index_data]['button'][$k]['name']==$feature['scenarios'][$i]['when'][$j]['parameter']){
                    //status bahwa button telah ada
                    $button_check = false;
                    break;
                  }
                }
                //jika form_element belum ada di $data, maka diinputkan
                if($button_check){
                  $button = [
                    'name' => $feature['scenarios'][$i]['when'][$j]['parameter'],
                    'url' => 0,
                    'messsage' => 0,
                  ];
                  //cek untuk url atau message effect button yg ada di then
                  for ($l=0; $l <count($feature['scenarios'][$i]['then']) ; $l++) {
                    //jika effect button url
                    if(strpos($feature['scenarios'][$i]['then'][$l]['command'], 'url') || strpos($feature['scenarios'][$i]['then'][$l]['command'], 'page')){
                       $button['url'] = $feature['scenarios'][$i]['then'][$l]['parameter'];
                    //jika effect button message/content
                    }elseif(strpos($feature['scenarios'][$i]['then'][$l]['command'], 'content') || strpos($feature['scenarios'][$i]['then'][$l]['command'], 'element')){
                       $button['message'] = $feature['scenarios'][$i]['then'][$l]['parameter'];
                    }
                  }
                  array_push($data[$index_data]['button'],$button);
                }
              }
            }
          }else{
            //jika di cek tidak ada, maka masukk an url ke data
            $content = [
                'url' => $url,
                'form' => [],
                'form_select' => [],
                'form_checkbox' => [],
                'button' => [],
            ];
            //cek untuk form_elements
            for($j=0;$j<count($feature['scenarios'][$i]['when']);$j++){
              if(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'form_element')){
                  $form = $feature['scenarios'][$i]['when'][$j]['parameter'];
                  array_push($content['form'],$form);
              }elseif(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'form_select')){
                  $form = $feature['scenarios'][$i]['when'][$j]['parameter'];
                  array_push($content['form_select'],$form);
              }elseif(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'form_checkbox')){
                  $form = $feature['scenarios'][$i]['when'][$j]['parameter'];
                  array_push($content['form_checkbox'],$form);
              }
            }
            //cek untuk button
            for($j=0;$j<count($feature['scenarios'][$i]['when']);$j++){
              if(strpos($feature['scenarios'][$i]['when'][$j]['command'], 'button')){
                  $button = [
                    'name' => $feature['scenarios'][$i]['when'][$j]['parameter'],
                    'url' => 0,
                    'messsage' => 0,
                  ];
                  //cek untuk url atau message effect button yg ada di then
                  for ($l=0; $l <count($feature['scenarios'][$i]['then']) ; $l++) {
                    //jika effect button url
                    if(strpos($feature['scenarios'][$i]['then'][$l]['command'], 'url') || strpos($feature['scenarios'][$i]['then'][$l]['command'], 'page')){
                       $button['url'] = $feature['scenarios'][$i]['then'][$l]['parameter'];
                    //jika effect button message/content
                    }elseif(strpos($feature['scenarios'][$i]['then'][$l]['command'], 'content') || strpos($feature['scenarios'][$i]['then'][$l]['command'], 'element')){
                       $button['message'] = $feature['scenarios'][$i]['then'][$l]['parameter'];
                    }
                  }
                  array_push($content['button'],$button);
              }
            }
            array_push($data,$content);
          }
        }
      }
      //generate ui
      //generate lokasi penyimpanan template
      $path = '/template/'.$id;
      //proses cek direktori
      if(!Storage::disk('document')->exists($path)){
        Storage::disk('document')->makeDirectory($path);
        //mencopy file dependensi template ke direktori
        $source = "public/template";
        $destination = storage_path('app/document').$path;
        File::copyDirectory(base_path($source), $destination);
      }
      //looping isi data
      for ($i=0; $i <count($data) ; $i++) {
        //tambah form
        $data[$i]['form_html'] = '';
        for ($j=0; $j <count($data[$i]['form']) ; $j++) {
            $data[$i]['form_html'] = $data[$i]['form_html'].'<div class="wrap-input100 validate-input m-b-26">'
            .'<span class="label-input100">'.$data[$i]['form'][$j].'</span>'
            .'<input class="input100" type="text" name="'.$data[$i]['form'][$j].'" placeholder="Masukkan '.$data[$i]['form'][$j].'">'
            .'<span class="focus-input100"></span>'
            .'</div>';
        }
        //tambah form_select
        $data[$i]['form_select_html'] = '';
        for ($j=0; $j <count($data[$i]['form_select']) ; $j++) {
            $data[$i]['form_select_html'] = $data[$i]['form_select_html'].'<div class="wrap-input100 validate-input m-b-26">'
            .'<span class="label-input100">'.$data[$i]['form_select'][$j].'</span>'
            .'<select class="input100 form-control">'
			      .'<option>Pilih Salah Satu</option>'
			      .'<option>Opsi 1</option>'
			      .'<option>Opsi 2</option>'
				    .'</select>'
            .'<span class="focus-input100"></span>'
            .'</div>';
        }
        //tambah form_checkbox
        $data[$i]['form_checkbox_html'] = '';
        for ($j=0; $j <count($data[$i]['form_checkbox']) ; $j++) {
            $data[$i]['form_checkbox_html'] = $data[$i]['form_checkbox_html'].'<div class="flex-sb-m w-full p-b-30">'
  						.'<div class="contact100-form-checkbox">'
  							.'<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">'
  							.'<label class="label-checkbox100" for="ckb1">'
  								.$data[$i]['form_checkbox'][$j]
  							.'</label>'
  						.'</div>'
  					.'</div>';
        }
        //tambah button
        $data[$i]['button_html']='';
        for ($j=0; $j <count($data[$i]['button']) ; $j++) {
          $data[$i]['button_html'] = $data[$i]['button_html'].'<a class="btn btn btn-success mb-2 mr-2" href="'.$data[$i]['button'][$j]['url'].'" role="button">'.$data[$i]['button'][$j]['name'].'</a>';
        }
        //menyatukan isi html nya
        $data[$i]['html'] = '<!DOCTYPE html>'
        .'<html lang="en">'
        .'<head>'
        	.'<title>'.$data[$i]['url'].'</title>'
        	.'<meta charset="UTF-8">'
        	.'<meta name="viewport" content="width=device-width, initial-scale=1">'
        	.'<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>'
        	.'<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">'
        	.'<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">'
        	.'<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">'
        	.'<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">'
        	.'<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">'
        	.'<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">'
        	.'<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">'
        	.'<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">'
        	.'<link rel="stylesheet" type="text/css" href="css/util.css">'
        	.'<link rel="stylesheet" type="text/css" href="css/main.css">'
        .'</head>'
        .'<body>'
        	.'<div class="limiter">'
        		.'<div class="container-login100">'
        			.'<div class="wrap-login100">'
        				.'<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">'
        					.'<span class="login100-form-title-1">'
        						.$data[$i]['url']
        					.'</span>'
        				.'</div>'
        				.'<div class="row px-5 mt-5">'
        					.'<div class="col-12">'
        						.'<h4 class="text-secondary">Form</h4>'
        						.'<hr>'
        					.'</div>'
        				.'</div>'
        				.'<form class="login100-form validate-form pt-0">'
        					.$data[$i]['form_html']
                  .$data[$i]['form_select_html']
                  .$data[$i]['form_checkbox_html']
        				.'</form>'
        				.'<div class="row my-5 px-5">'
        					.'<div class="col-12">'
        						.'<h4 class="text-secondary">Button</h4>'
        						.'<hr>'
        						.$data[$i]['button_html']
        					.'</div>'
        				.'</div>'
        			.'</div>'
        		.'</div>'
        	.'</div>'
        	.'<script src="vendor/jquery/jquery-3.2.1.min.js"></script>'
        	.'<script src="vendor/animsition/js/animsition.min.js"></script>'
        	.'<script src="vendor/bootstrap/js/popper.js"></script>'
        	.'<script src="vendor/bootstrap/js/bootstrap.min.js"></script>'
        	.'<script src="vendor/select2/select2.min.js"></script>'
        	.'<script src="vendor/daterangepicker/moment.min.js"></script>'
        	.'<script src="vendor/daterangepicker/daterangepicker.js"></script>'
        	.'<script src="vendor/countdowntime/countdowntime.js"></script>'
        	.'<script src="js/main.js"></script>'
        .'</body>'
        .'</html>';
        File::put(storage_path('app/document').$path.'/'.$data[$i]['url'],$data[$i]['html']);
      }
      //buat zip file
        $fileName = $project['name'].'.zip';
        $source = storage_path('app/document').$path;
        $destination = storage_path('app/document').'/template/'.$fileName;
        //proses cek zip, jika sudah ada sebelumnya dihapus
        if(Storage::disk('document')->exists('template/'.$fileName)){
          Storage::disk('document')->delete('template/'.$fileName);
        }
        //buat zip
        $this->zipDir($source, $destination);
        return response()->download($destination);
     }

     //function buat zip
     private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
        $handle = opendir($folder);
        while (false !== $f = readdir($handle)) {
          if ($f != '.' && $f != '..') {
            $filePath = "$folder/$f";
            // Remove prefix from file path before add to zip.
            $localPath = substr($filePath, $exclusiveLength);
            if (is_file($filePath)) {
              $zipFile->addFile($filePath, $localPath);
            } elseif (is_dir($filePath)) {
              // Add sub-directory.
              $zipFile->addEmptyDir($localPath);
              self::folderToZip($filePath, $zipFile, $exclusiveLength);
            }
          }
        }
        closedir($handle);
      }
      public static function zipDir($sourcePath, $outZipPath)
      {
        $pathInfo = pathInfo($sourcePath);
        $parentPath = $pathInfo['dirname'];
        $dirName = $pathInfo['basename'];

        $z = new ZipArchive();
        $z->open($outZipPath, ZIPARCHIVE::CREATE);
        $z->addEmptyDir($dirName);
        self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
        $z->close();
      }
}
