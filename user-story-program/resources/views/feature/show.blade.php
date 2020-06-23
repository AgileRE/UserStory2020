@extends('layout')
@section('style')
@endsection
@section('content')

    <div class="popular_places_area">
        <div class="container">
          <div class="row ml-3">
            <div class="col-12">
              <div class="single_place shadow-lg pl-1" style="width:40px; height:40px;border-radius:50%;">
                <div class="place_info p-0 ml-2 mt-2">
                  <a href="{{route('project.show',['project_id'=>$project->id()])}}"><i class="fa fa-arrow-left text-info"></i></a>
                </div>
              </div>
            </div>
          </div>
            <div class="row ml-3">
                <div class="col-lg-8">
                    <div class="section_title text-left mb_70">
                        <!-- judul -->
                        <div class="mb-3">
                          <h5 class="mb-1 text-secondary">Project {{$project['name']}}</h5>
                          <h3 class="mb-0 pb-0">User Story {{$feature['name']}}
                            <a href="#" class="text-secondary ml-1 mb-0 pb-0" style="font-size:16px;" data-toggle="modal" data-target="#editFeature"><i class="fa fa-pen mb-0 pb-0"></i></a>
                          </h3>
                          <!-- <span class="badge badge-pill badge-warning font-weight-normal py-1 px-3">Project {{$project['name']}}</span> -->
                        </div>
                        <!-- peran -->
                        <div class="">
                          <h5 class="mb-0">Peran</h5>
                          <p class="mb-3 text-justify">{{$feature['role']}}</p>
                        </div>
                        <!-- deskripsi -->
                        <div class="">
                          <h5 class="mb-0">Deskripsi</h5>
                          <p class="mb-5 text-justify">{{$feature['description']}}</p>
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createScenario">
                          Tambah Skenario
                        </button>
                        <!-- Modal buat skenario -->
                        <div class="modal fade" id="createScenario" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                          <div class="modal-dialog" role="document" style="margin:10vh 20vw 0 20vw">
                              <div class="modal-content" style="width:60vw;">
                                  <div class="modal-body px-4 py-4">
                                    <div class="row mb-4">
                                      <div class="col-md-8 col-8">
                                        <h5 class="modal-title mt-1">Buat Skenario</h5>
                                      </div>
                                      <div class="col-md-4 col-4">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    </div>
                                    <form id="createScenarioForm" action="{{ route('scenario.store',['project_id'=>$project->id(),'feature_id'=>$feature->id()]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row mb-3">
                                      <div class="col-8">
                                          <div class="form-group">
                                            <label class="text-body">Nama Skenario</label>
                                            <input type="text" name="name" class="form-control">
                                          </div>
                                      </div>
                                    </div>
                                    <!-- <div class="row">
                                      <div class="col-8">
                                        <div class="multi-field-wrapper">
                                          <div class="multi-fields">
                                            <div class="multi-field">
                                              <div class="row">
                                                <div class="col-3">
                                                  <p class="mt-1 text-body">Given</p>
                                                </div>
                                                <div class="col-9">
                                                  <div class="input-group mb-3">
                                                    <input type="text" name="given[]" class="form-control">
                                                    <div class="input-group-append">
                                                      <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <button type="button" class="add-field btn btn-info btn-sm">Tambah And</button>
                                            </div>
                                          </div>
                                      </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-8">
                                        <div class="multi-field-wrapper">
                                          <div class="multi-fields">
                                            <div class="multi-field">
                                              <div class="row">
                                                <div class="col-3">
                                                  <p class="mt-1 text-body">When</p>
                                                </div>
                                                <div class="col-9">
                                                  <div class="input-group mb-3">
                                                    <input type="text" name="when[]" class="form-control">
                                                    <div class="input-group-append">
                                                      <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <button type="button" class="add-field btn btn-info btn-sm">Tambah And</button>
                                            </div>
                                          </div>
                                      </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-8">
                                        <div class="multi-field-wrapper">
                                          <div class="multi-fields">
                                            <div class="multi-field">
                                              <div class="row">
                                                <div class="col-3">
                                                  <p class="mt-1 text-body">Then</p>
                                                </div>
                                                <div class="col-9">
                                                  <div class="input-group mb-3">
                                                    <input type="text" name="then[]" class="form-control">
                                                    <div class="input-group-append">
                                                      <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row mb-3">
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <button type="button" class="add-field btn btn-info btn-sm">Tambah And</button>
                                            </div>
                                          </div>
                                      </div>
                                      </div>
                                    </div> -->
                                    </form>
                                    <div class="row">
                                    <div class="col align-self-end">
                                      <div align="right">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" form="createScenarioForm" class="btn btn-info btn-sm">Simpan</button>
                                      </div>
                                    </div>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                        <!-- end modal -->
                        <!-- Modal edit user story -->
                        <div class="modal fade" id="editFeature" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                          <div class="modal-dialog" role="document" style="margin:10vh 20vw 0 20vw">
                              <div class="modal-content" style="width:60vw;">
                                  <div class="modal-body px-4 py-4">
                                    <div class="row mb-4">
                                      <div class="col-md-8 col-8">
                                        <h5 class="modal-title mt-1">Edit User Story</h5>
                                      </div>
                                      <div class="col-md-4 col-4">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    </div>
                                    <form id="editFeatureForm" action="{{ route('feature.update',['project_id'=>$project->id(),'id'=>$feature->id()]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row mb-3">
                                      <div class="col-8">
                                          <div class="form-group">
                                            <label class="text-body">Nama User Story</label>
                                            <input type="text" name="name" value="{{$feature['name']}}" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            <label class="text-body">Peran dalam User Story</label>
                                            <input type="text" name="role" value="{{$feature['role']}}" class="form-control">
                                          </div>
                                          <div class="form-group">
                                            <label class="text-body">Deskripsi Project</label>
                                            <textarea class="form-control" name="description" rows="3">{{$feature['description']}}</textarea>
                                          </div>
                                      </div>
                                    </div>
                                    </form>
                                    <div class="row">
                                    <div class="col align-self-end">
                                      <div align="right">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" form="editFeatureForm" class="btn btn-info btn-sm">Simpan</button>
                                      </div>
                                    </div>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                        <!-- end modal -->
                    </div>
                </div>
            </div>
            <!-- alert -->
            @if ($message = Session::get('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle"></i> <strong>Tidak Berhasil!</strong> {{$message}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle"></i> <strong>Berhasil!</strong> {{$message}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            <!-- card skenario -->
            @for($i=0;$i<count($feature['scenarios']);$i++)
            <div class="row">
              <div class="col-12">
                <div class="single_place shadow-lg rounded">
                    <div class="place_info mx-3 my-2">
                      <div class="row">
                        <div class="col-8">
                          <h4 class="mt-1">{{$feature['scenarios'][$i]['name']}}</h4>
                        </div>
                        <div class="col-4">
                          <div class="float-right">
                            <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editScenario{{$i}}">Edit</a>
                            <!-- Modal edit -->
                            <div class="modal fade" id="editScenario{{$i}}" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                              <div class="modal-dialog" role="document" style="margin:10vh 20vw 0 20vw">
                                  <div class="modal-content" style="width:60vw;">
                                      <div class="modal-body px-4 py-4">
                                        <div class="row mb-4">
                                          <div class="col-md-8 col-8">
                                            <h5 class="modal-title mt-1">Edit Skenario</h5>
                                          </div>
                                          <div class="col-md-4 col-4">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                        </div>
                                        <form id="editScenarioForm{{$i}}" action="{{ route('scenario.update',['project_id'=>$project->id(),'feature_id'=>$feature->id(),'id'=>$i]) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row mb-3">
                                          <div class="col-8">
                                              <div class="form-group">
                                                <label class="text-body">Nama Skenario</label>
                                                <input type="text" name="name" value="{{$feature['scenarios'][$i]['name']}}" class="form-control">
                                              </div>
                                          </div>
                                        </div>
                                        </form>
                                        <div class="row">
                                        <div class="col align-self-end">
                                          <div align="right">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                            <button type="submit" form="editScenarioForm{{$i}}" class="btn btn-info btn-sm">Simpan</button>
                                          </div>
                                        </div>
                                        </div>
                                      </div>
                                  </div>
                               </div>
                            </div>
                            <!-- end modal edit -->
                            <a href="{{route('scenario.destroy',['project_id'=>$project->id(),'feature_id'=>$feature->id(),'id'=>$i])}}" class="btn btn-sm btn-danger">Hapus</a>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Command</th>
                            <th scope="col">Parameter <span class="text-secondary" style="font-size:12px;">(url/form_element/button)</span></th>
                            <th scope="col">Value</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- given -->
                          @if(count($feature['scenarios'][$i]['given'])!=0)
                            @for($j=0;$j<count($feature['scenarios'][$i]['given']);$j++)
                            <tr>
                              <td><strong>Given</strong></td>
                              <td>{{$feature['scenarios'][$i]['given'][$j]['command']}}</td>
                              <td>{{$feature['scenarios'][$i]['given'][$j]['parameter']}}</td>
                              @if($feature['scenarios'][$i]['given'][$j]['value']==null)
                              <td><span class="text-secondary">null</span></td>
                              @else
                              <td>{{$feature['scenarios'][$i]['given'][$j]['value']}}</td>
                              @endif
                              <td>
                                <a href="{{route('scenario.content.destroy',['project_id'=>$project->id(),'feature_id'=>$feature->id(),'scenario_id'=>$i,'type'=>'given', 'id'=>$j])}}" class="btn btn-sm btn-danger">Hapus</a>
                              </td>
                            </tr>
                            @endfor
                          @endif
                          <!-- when -->
                          @if(count($feature['scenarios'][$i]['when'])!=0)
                            @for($j=0;$j<count($feature['scenarios'][$i]['when']);$j++)
                            <tr>
                              <td><strong>When</strong></td>
                              <td>{{$feature['scenarios'][$i]['when'][$j]['command']}}</td>
                              <td>{{$feature['scenarios'][$i]['when'][$j]['parameter']}}</td>
                              @if($feature['scenarios'][$i]['when'][$j]['value']==null)
                              <td><span class="text-secondary">null</span></td>
                              @else
                              <td>{{$feature['scenarios'][$i]['when'][$j]['value']}}</td>
                              @endif
                              <td>
                                <a href="{{route('scenario.content.destroy',['project_id'=>$project->id(),'feature_id'=>$feature->id(),'scenario_id'=>$i,'type'=>'when', 'id'=>$j])}}" class="btn btn-sm btn-danger">Hapus</a>
                              </td>
                            </tr>
                            @endfor
                          @endif
                          <!-- then -->
                          @if(count($feature['scenarios'][$i]['then'])!=0)
                            @for($j=0;$j<count($feature['scenarios'][$i]['then']);$j++)
                            <tr>
                              <td><strong>Then</strong></td>
                              <td>{{$feature['scenarios'][$i]['then'][$j]['command']}}</td>
                              <td>{{$feature['scenarios'][$i]['then'][$j]['parameter']}}</td>
                              @if($feature['scenarios'][$i]['then'][$j]['value']==null)
                              <td><span class="text-secondary">null</span></td>
                              @else
                              <td>{{$feature['scenarios'][$i]['then'][$j]['value']}}</td>
                              @endif
                              <td>
                                <a href="{{route('scenario.content.destroy',['project_id'=>$project->id(),'feature_id'=>$feature->id(),'scenario_id'=>$i,'type'=>'then', 'id'=>$j])}}" class="btn btn-sm btn-danger">Hapus</a>
                              </td>
                            </tr>
                            @endfor
                          @endif
                        </tbody>
                      </table>
                      <div class="row my-2">
                        <div class="col-12">
                          <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addStep{{$i}}">Tambah Step Skenario</a>
                          <!-- Modal tambah konten skenario -->
                          <div class="modal fade" id="addStep{{$i}}" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin:10vh 20vw 0 20vw">
                                <div class="modal-content" style="width:60vw;">
                                    <div class="modal-body px-4 py-4">
                                      <div class="row mb-4">
                                        <div class="col-md-8 col-8">
                                          <h5 class="modal-title mt-1">Tambah Step Skenario</h5>
                                        </div>
                                        <div class="col-md-4 col-4">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                      </div>
                                      <form id="addStepForm{{$i}}" action="{{ route('scenario.content.store',['project_id'=>$project->id(),'feature_id'=>$feature->id(),'scenario_id'=>$i]) }}" method="post" enctype="multipart/form-data">
                                      {{ csrf_field() }}
                                      <div class="row mb-3">
                                        <div class="col-8">
                                            <div class="form-group">
                                              <label class="text-body">Tipe Step</label>
                                              <select name="type" id="type_list{{$i}}" class="form-control" onchange="commandList({{$i}});">
                                                <option selected disabled>Pilih Salah Satu</option>
                                                <option value="given">Given</option>
                                                <option value="when">When</option>
                                                <option value="then">Then</option>
                                              </select>
                                            </div>
                                            <div class="form-group mt-5" id="command_container{{$i}}">
                                              <label class="text-body">Command</label>
                                              <select name="command" id="command_list{{$i}}" class="form-control">
                                              </select>
                                            </div>
                                            <div class="form-group mt-5">
                                              <label class="text-body">Parameter (url/form_name/button_name)</label>
                                              <input type="text" name="parameter" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label class="text-body">Value (optional)</label>
                                              <input type="text" name="value" class="form-control">
                                            </div>
                                        </div>
                                      </div>
                                      </form>
                                      <div class="row">
                                      <div class="col align-self-end">
                                        <div align="right">
                                          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                          <button type="submit" form="addStepForm{{$i}}" class="btn btn-info btn-sm">Simpan</button>
                                        </div>
                                      </div>
                                      </div>
                                    </div>
                                </div>
                             </div>
                          </div>
                          <!-- end modal tambah konten skenario -->
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            @endfor
            <!-- end card scenario -->

        </div>
    </div>
    <footer class="footer">
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


  <!-- Modal -->
  <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="serch_form">
            <input type="text" placeholder="Search" >
            <button type="submit">search</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script>
// buat populate input Tag
$('.multi-field-wrapper').each(function() {
  var $wrapper = $('.multi-fields', this);
  $(".add-field", $(this)).click(function(e) {
      var clone = $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).focus();
      clone.find('p').html('And');
      clone.find('input').val('')
  });
  $('.input-group-append .remove-field', $wrapper).click(function() {
      if ($('.multi-field', $wrapper).length > 1)
          $(this).parent('.input-group-append').parent('.input-group').parent('.col-9').parent('.row').parent('.multi-field').remove();
  });
});

function commandList(id){
  var selectType = document.getElementById("type_list"+id);
  var type = selectType.options[selectType.selectedIndex].value;
  var list = "<option selected disabled>Pilih Salah Satu</option>";
  var list_select ="<li data-value='Pilih Salah Satu' class='option disabled focus'>Pilih Salah Satu</li>";
  if(type=='given'){
    list = "<option selected disabled>Pilih Salah Satu</option>";
    list_select ="<li data-value='Pilih Salah Satu' class='option disabled focus'>Pilih Salah Satu</li>";
    var command_given = [
      @foreach($command_given['command_list'] as $command)
        '{{$command}}',
      @endforeach
    ];
    for (i = 0; i < command_given.length; i++) {
      list += "<option value='"+command_given[i]+"'>"+command_given[i]+"</option>"
    }
    for (i = 0; i < command_given.length; i++) {
      list_select += "<li data-value='"+command_given[i]+"' class='option'>"+command_given[i]+"</li>"
    }
    document.getElementById("command_list"+id).innerHTML = list;
    document.getElementById("command_container"+id).getElementsByClassName('nice-select')[0].getElementsByClassName('current')[0].innerHTML = 'Pilih Salah Satu';
    document.getElementById("command_container"+id).getElementsByClassName('nice-select')[0].getElementsByClassName('list')[0].innerHTML = list_select;
  }else if(type=='when'){
    list = "<option selected disabled>Pilih Salah Satu</option>";
    list_select ="<li data-value='Pilih Salah Satu' class='option disabled focus'>Pilih Salah Satu</li>";
    var command_when = [
      @foreach($command_when['command_list'] as $command)
        '{{$command}}',
      @endforeach
    ];
    for (i = 0; i < command_when.length; i++) {
      list += "<option value='"+command_when[i]+"'>"+command_when[i]+"</option>"
    }
    for (i = 0; i < command_when.length; i++) {
      list_select += "<li data-value='"+command_when[i]+"' class='option'>"+command_when[i]+"</li>"
    }
    document.getElementById("command_list"+id).innerHTML = list;
    document.getElementById("command_container"+id).getElementsByClassName('nice-select')[0].getElementsByClassName('current')[0].innerHTML = 'Pilih Salah Satu';
    document.getElementById("command_container"+id).getElementsByClassName('nice-select')[0].getElementsByClassName('list')[0].innerHTML = list_select;
  }
  else if(type=='then'){
    list = "<option selected disabled>Pilih Salah Satu</option>";
    list_select ="<li data-value='Pilih Salah Satu' class='option disabled focus'>Pilih Salah Satu</li>";
    var command_then = [
      @foreach($command_then['command_list'] as $command)
        '{{$command}}',
      @endforeach
    ];
    for (i = 0; i < command_then.length; i++) {
      list += "<option value='"+command_then[i]+"'>"+command_then[i]+"</option>"
    }
    for (i = 0; i < command_then.length; i++) {
      list_select += "<li data-value='"+command_then[i]+"' class='option'>"+command_then[i]+"</li>"
    }
    document.getElementById("command_list"+id).innerHTML = list;
    document.getElementById("command_container"+id).getElementsByClassName('nice-select')[0].getElementsByClassName('current')[0].innerHTML = 'Pilih Salah Satu';
    document.getElementById("command_container"+id).getElementsByClassName('nice-select')[0].getElementsByClassName('list')[0].innerHTML = list_select;
  }
}
</script>
@endsection
