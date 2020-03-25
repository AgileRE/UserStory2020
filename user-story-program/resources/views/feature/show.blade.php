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
                                    <div class="row">
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
                                    </div>
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
                                        <div class="row">
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
                                                        <input type="text" name="given[]" value="{{$feature['scenarios'][$i]['given'][0]}}" class="form-control">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                @for($j=1;$j<count($feature['scenarios'][$i]['given']);$j++)
                                                <div class="multi-field">
                                                  <div class="row">
                                                    <div class="col-3">
                                                      <p class="mt-1 text-body">And</p>
                                                    </div>
                                                    <div class="col-9">
                                                      <div class="input-group mb-3">
                                                        <input type="text" name="given[]" value="{{$feature['scenarios'][$i]['given'][$j]}}" class="form-control">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                @endfor
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
                                                        <input type="text" name="when[]" value="{{$feature['scenarios'][$i]['when'][0]}}" class="form-control">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                @for($j=1;$j<count($feature['scenarios'][$i]['when']);$j++)
                                                <div class="multi-field">
                                                  <div class="row">
                                                    <div class="col-3">
                                                      <p class="mt-1 text-body">And</p>
                                                    </div>
                                                    <div class="col-9">
                                                      <div class="input-group mb-3">
                                                        <input type="text" name="when[]" value="{{$feature['scenarios'][$i]['when'][$j]}}" class="form-control">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                @endfor
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
                                                        <input type="text" name="then[]" value="{{$feature['scenarios'][$i]['then'][0]}}" class="form-control">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                @for($j=1;$j<count($feature['scenarios'][$i]['then']);$j++)
                                                <div class="multi-field">
                                                  <div class="row">
                                                    <div class="col-3">
                                                      <p class="mt-1 text-body">And</p>
                                                    </div>
                                                    <div class="col-9">
                                                      <div class="input-group mb-3">
                                                        <input type="text" name="then[]" value="{{$feature['scenarios'][$i]['then'][$j]}}" class="form-control">
                                                        <div class="input-group-append">
                                                          <button class="btn btn-danger remove-field" type="button">Hapus</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                @endfor
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
                        <tbody>
                          <!-- given -->
                          <tr>
                            <td style="width:20%;"><strong>Given</strong></td>
                            <td>{{$feature['scenarios'][$i]['given'][0]}}</td>
                          </tr>
                          @for($j=1;$j<count($feature['scenarios'][$i]['given']);$j++)
                          <tr>
                            <td style="width:20%;"><strong>And</strong></td>
                            <td>{{$feature['scenarios'][$i]['given'][$j]}}</td>
                          </tr>
                          @endfor
                          <!-- when -->
                          <tr>
                            <td style="width:20%;"><strong>When</strong></td>
                            <td>{{$feature['scenarios'][$i]['when'][0]}}</td>
                          </tr>
                          @for($j=1;$j<count($feature['scenarios'][$i]['when']);$j++)
                          <tr>
                            <td style="width:20%;"><strong>And</strong></td>
                            <td>{{$feature['scenarios'][$i]['when'][$j]}}</td>
                          </tr>
                          @endfor
                          <!-- then -->
                          <tr>
                            <td style="width:20%;"><strong>Then</strong></td>
                            <td>{{$feature['scenarios'][$i]['then'][0]}}</td>
                          </tr>
                          @for($j=1;$j<count($feature['scenarios'][$i]['then']);$j++)
                          <tr>
                            <td style="width:20%;"><strong>And</strong></td>
                            <td>{{$feature['scenarios'][$i]['then'][$j]}}</td>
                          </tr>
                          @endfor
                        </tbody>
                      </table>
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
</script>
@endsection
