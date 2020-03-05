@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Photos</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row">
            <div class="col-md-5"></div>
            <div class="col-sm-12 col-md-4">
            <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-3"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">New Photo</h1>
                    </div>
                    <form class="user" enctype="multipart/form-data" action="{{ route('photo.store')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                        <div class="col-12">
                            <a href="javascript:void(0)" class="d-block m-auto">
                                <img id="newUserImage" onclick="document.querySelector('#image').click()" class="img-profile rounded-circle d-block m-auto" style="height: 150px; max-width: 150px" src="{{ asset('storage/default/avatar.png')}}">
                            </a>
                        <input type="file" name="path" class="form-control form-control-user d-none @error('path') is-invalid @enderror" id="image" required>
                            @error('path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Upload">
                            </div>
                        </div>
                    </form>
                  </div>
                <div class="col-sm-12 col-md-8">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
          <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55px;">Image</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Url</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 52px;">Actions</th>
                {{-- <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Actions</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 61px;">Treasurer</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 63px;">Salary</th></tr> --}}
          </thead>
          <tfoot>
            <tr>
                <th rowspan="1" colspan="1">Image</th>
                <th rowspan="1" colspan="1">Url</th>
                <th rowspan="1" colspan="1">Actions</th>
                {{-- <th rowspan="1" colspan="1">Action</th>
                <th rowspan="1" colspan="1">Start date</th>
                <th rowspan="1" colspan="1">Salary</th> --}}
            </tr>
          </tfoot>
          <tbody>
              @if (count($photos) > 0)
                @foreach ($photos as $photo)
                    <tr id="m_{{$photo->id}}" role="row" class="odd m-category">
                        <td class="sorting_1">
                            <img class="img-profile rounded-circle d-block m-auto" style="height: 150px; width: 150px" src="@if($photo->path != null){{ asset('' . $photo->path) }} @else{{ asset('storage/default/avatar.png')}} @endif">
                        </td>
                        <td style="max-width: 200px;"><a href="{{asset('' . $photo->path)}}" target="_blank">{{$photo->path}}</a></td>
                        <td>
                            <span>
                                <form action="{{ route('photo.delete', ['photo' => $photo->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="right" value="no">
                                    <button type="submit" class="btn btn-danger btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Delete</span>
                                    </button>
                                </form>
                            </span>
                            <a href="javascript:void(0)" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#m{{$photo->id}}">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                        <!-- Update Modal-->
                        <div class="modal fade" id="m{{$photo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Photo</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form class="user" enctype="multipart/form-data" action="{{ route('photo.update', ['photo' => $photo->id])}}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <a href="javascript:void(0)" class="d-block m-auto">
                                                            <img id="updateMinistryImage_m_{{$photo->id}}" onclick="document.querySelector('#updateMinistryLogo_m_{{$photo->id}}').click()" class="img-profile rounded-circle d-block m-auto" style="height: 150px; width: 150px" src="{{ asset('storage/' . $photo->path) ?? asset('storage/default/avatar.png')}}">
                                                        </a>
                                                        <input type="file" name="path" class="form-control form-control-user d-none @error('path') is-invalid @enderror" id="updateMinistryLogo_m_{{$photo->id}}" placeholder="Logo">
                                                        @error('path')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> --}}
                                {{-- <a class="btn btn-primary" href="login.html">Update</a> --}}
                                </div>
                            </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
              @else
                  <tr class="odd m-category">
                      <td>No Photos Found</td>
                  </tr>
              @endif
        </tbody>
        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
      </div>
    </div>
  </div>

@endsection

@section('nicEdit')
    <script type="text/javascript">

        var mCategory = $('.m-category');

        bkLib.onDomLoaded(function() {
            // new nicEditor().panelInstance('area1');
            // new nicEditor({fullPanel : true}).panelInstance('newMinistryDescription');
            for (let index = 0; index < mCategory.length; index++) {
                const element = mCategory[index].id;
                // new nicEditor({fullPanel : true}).panelInstance(`updateMinistryDescription_${element}`);

                // document.querySelector(`#updateMinistryDescription_${element}`).previousSibling.firstChild.addEventListener('input', function(){
                //     document.querySelector(`#updateMinistryDescription_${element}`).value = this.innerHTML;
                // })

                //show chosen logo
                $(`#updateMinistryLogo_${element}`).change(function() {
                    var reader = new FileReader();
                    reader.onload = function(){
                        let dataUrl = reader.result
                        document.querySelector(`#updateMinistryImage_${element}`).src = dataUrl
                    }

                    let file = $(`#updateMinistryLogo_${element}`).prop('files')[0]
                    reader.readAsDataURL(file)
                })
            }
            // new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
            // new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
            // new nicEditor({maxHeight : 100}).panelInstance('area5');
        });

        $(document).ready(() => {
            //show chosen logo
            $('#image').change(function() {
                var reader = new FileReader();
                reader.onload = function(){
                    let dataUrl = reader.result
                    document.querySelector('#newUserImage').src = dataUrl
                }

                let file = $('#image').prop('files')[0]
                reader.readAsDataURL(file)
            })

        })
        </script>
@endsection

@section('groups')
    @if (Auth::user()->membership != null)
        @foreach(Auth::user()->membership as $leader)
            @if($leader->post != 'member' && $leader->post != 'alumni' && $leader->right == 'yes')
                <a class="collapse-item" href="{{route('cohort.show', ['cohort' => $leader->cohort_id])}}">{{$leader->cohort->name}}</a>
            @endif
        @endforeach
    @endif
@endsection
