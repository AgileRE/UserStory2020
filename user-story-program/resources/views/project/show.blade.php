@extends('layout')
@section('style')

@endsection
@section('content')
    <div class="popular_places_area">
        <div class="container">
          <div class="row ml-3">
            <div class="col-12">
              <a href="{{route('project.index')}}">
              <div class="single_place shadow-lg pl-1" style="width:40px; height:40px;border-radius:50%;">
                <div class="place_info p-0 ml-2 mt-2">
                  <i class="fa fa-arrow-left text-info"></i>
                </div>
              </div>
              </a>
            </div>
          </div>
            <div class="row ml-3">
                <div class="col-lg-8">
                    <div class="section_title text-left mb_70">
                        <h3>Project {{$project['name']}}
                          <a href="#" class="text-secondary ml-1" style="font-size:16px;" data-toggle="modal" data-target="#editProject"><i class="fa fa-pen"></i></a>
                        </h3>
                        <p class="mb-3">{{$project['description']}}</p>
                        <a href="" type="button" class="btn btn-info" data-toggle="modal" data-target="#createFeature">
                          Tambah User Story
                        </a>
                        <a href="" type="button" class="btn btn-info" data-toggle="modal" data-target="#createFeature">
                          Generate User Interface
                        </a>
                        <!-- Modal tambah user story -->
                        <div class="modal fade" id="createFeature" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                          <div class="modal-dialog" role="document" style="margin:10vh 20vw 0 20vw">
                              <div class="modal-content" style="width:60vw;">
                                  <div class="modal-body px-4 py-4">
                                    <div class="row mb-4">
                                      <div class="col-md-8 col-8">
                                        <h5 class="modal-title mt-1">Buat Fitur </h5>
                                      </div>
                                      <div class="col-md-4 col-4">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    </div>
                                    <form id="createFeatureForm" action="{{ route('feature.store',['project_id'=>$project->id()]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row mb-3">
                                      <div class="col-8">
                                          <div class="form-group">
                                            <label class="text-body">Nama User Story</label>
                                            <input type="text" name="name" class="form-control" required>
                                          </div>
                                          <div class="form-group">
                                            <label class="text-body">Peran dalam User Story</label>
                                            <input type="text" name="role" class="form-control" required>
                                          </div>
                                          <div class="form-group">
                                            <label class="text-body">Deskripsi User Story</label>
                                            <textarea class="form-control" name="description" rows="5"></textarea>
                                          </div>
                                      </div>
                                    </div>
                                    </form>
                                    <div class="row">
                                    <div class="col align-self-end">
                                      <div align="right">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" form="createFeatureForm" class="btn btn-info btn-sm">Simpan</button>
                                      </div>
                                    </div>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                        <!-- end modal -->
                        <!-- Modal edit projek -->
                        <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                          <div class="modal-dialog" role="document" style="margin:10vh 20vw 0 20vw">
                              <div class="modal-content" style="width:60vw;">
                                  <div class="modal-body px-4 py-4">
                                    <div class="row mb-4">
                                      <div class="col-md-8 col-8">
                                        <h5 class="modal-title mt-1">Edit Project</h5>
                                      </div>
                                      <div class="col-md-4 col-4">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                    </div>
                                    <form id="editProjectForm" action="{{ route('project.update',['id'=>$project->id()]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row mb-3">
                                      <div class="col-8">
                                          <div class="form-group">
                                            <label class="text-body">Nama Project</label>
                                            <input type="text" name="name" class="form-control" value="{{$project['name']}}">
                                          </div>
                                          <div class="form-group">
                                            <label class="text-body">Deskripsi Project</label>
                                            <textarea class="form-control" name="description" rows="5">{{$project['description']}}</textarea>
                                          </div>
                                      </div>
                                    </div>
                                    </form>
                                    <div class="row">
                                    <div class="col align-self-end">
                                      <div align="right">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" form="editProjectForm" class="btn btn-info btn-sm">Simpan</button>
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
            <div class="row">
              <div class="col-12">
                <div class="single_place shadow-lg rounded">
                    <div class="place_info mx-3 my-2">
                      <div class="row mb-3">
                        <div class="col-12 col-md-8">
                          <input id="mySearch" type="search" class="form-control" placeholder="Cari...">
                        </div>
                        <div class="col-12 col-md-4 pl-0">
                          <i class="fas fa-search mt-2" style="font-size:20px;"></i>
                        </div>
                      </div>
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col" style="width:50%">Nama User Story</th>
                            <th scope="col">Peran</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                          ?>
                          @foreach($feature as $document)
                          <tr class="this-search">
                            <th scope="row">{{$i}}</th>
                            <td>{{$document['name']}}</td>
                            <td>{{$document['role']}}</td>
                            <td>
                              <a href="{{route('feature.show',['project_id'=>$project->id(),'feature_id'=>$document->id()])}}" class="btn btn-sm btn-info">Lihat</a>
                              <a href="{{route('feature.destroy',['project_id'=>$project->id(),'id'=>$document->id()])}}" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                          </tr>
                          <?php $i++; ?>
                          @endforeach
                        </tbody>
                        </table>
                        <div align="center">
                          <h5 id="not-found" class="text-secondary my-5"></h5>
                        </div>
                    </div>
                </div>
              </div>
            </div>
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
// untuk cari data
$(document).ready(function(){
  $("#mySearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".this-search").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
    if($('.this-search:visible').length===0){
      $('#not-found').show().html("User Story tidak ditemukan");
    }else{
      $('#not-found').hide();
    }
  });
});
// untuk hitung jumlah baris
var count = $('.this-search').length;
checkCountData();
function checkCountData(){
  if(count==0){
    $('#not-found').show().html("Belum ada data");
  }else{
    $('#not-found').hide();
  }
}
</script>
@endsection
