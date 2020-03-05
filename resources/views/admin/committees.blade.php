@extends('layouts.admin')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Committees</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row">
            <div class="col-md-5"></div>
            <div class="col-sm-12 col-md-4">
            <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-3"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Register Committee</h1>
                    </div>
                    <form class="user" enctype="multipart/form-data" action="{{ route('cohort.store')}}" method="POST">
                        @csrf
                          <div class="form-group row">
                            <div class="col-sm-12">
                                <a href="javascript:void(0)">
                                    <img id="newCommitteeImage" onclick="document.querySelector('#newCommitteeLogo').click()" class="img-profile rounded-circle d-block m-auto" style="height: 250px; width: 250px" src="{{ asset('storage/default/avatar.png')}}">
                                </a>
                              <input type="file" name="image" class="form-control form-control-user d-none @error('image') is-invalid @enderror" id="newCommitteeLogo">
                              @error('image')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              <input type="hidden" name="category" value="committee">
                            </div>
                            <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                              <input type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleFirstName" placeholder="Name" required>
                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-12">
                                <textarea class="w-100 @error('about') is-invalid @enderror" name="about" id="newCommitteeDescription" required>About Committee</textarea>
                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register">
                              </div>
                          </div>
                        </form>
                  </div>
                <div class="col-sm-12 col-md-8">
                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
          <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55px;">Logo</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Name</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 52px;">Chairperson</th>
                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Actions</th>
          </thead>
          <tfoot>
            <tr>
                <th rowspan="1" colspan="1">Logo</th>
                <th rowspan="1" colspan="1">Name</th>
                <th rowspan="1" colspan="1">Chairperson</th>
                <th rowspan="1" colspan="1">Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $chair = 'No chairperson yet'; $ministry = 0 ?>
            @if (count($cohorts) > 0)
              @foreach ($cohorts as $cohort)
                  @if ($cohort->category == 'committee')
                      <tr id="m_{{$cohort->id}}" role="row" class="odd m-category">
                          <td class="sorting_1">
                          <img class="img-profile rounded-circle d-block m-auto" style="height: 50px; width: 50px" src="@if($cohort->image != null){{ asset('' . $cohort->image) }} @else{{ asset('storage/default/avatar.png')}} @endif">
                          </td>
                          <td>{{$cohort->name}}</td>
                          @if ($cohort->membership != null)
                              @foreach ($cohort->membership as $leader)
                                  @if ($leader->post == 'chairperson' && $leader->right == 'yes')
                                      {{$chair = $leader->user->profile->fname}}
                                  @endif
                              @endforeach
                          @else
                          @endif
                          <td>{{$chair}}</td>
                          <?php $chair = "No chairperson yet" ?>

                          <td class="">
                              <div class="d-flex">
                                <a href="javascript:void(0)" class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#m{{$cohort->id}}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form id="del_" action="{{ route('cohort.delete', ['cohort' => $cohort->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm border-0" name="">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                              </div>
                          {{-- <a href="javascript:void(0)" onclick="see(this)" class="btn btn-danger btn-circle btn-sm">
                              <i class="fas fa-trash"></i>
                          </a> --}}
                          </td>
                          <!-- Update Modal-->
                          <div class="modal fade" id="m{{$cohort->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Update {{$cohort->name}}</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="container">
                                      <div class="row">
                                          <div class="col-sm-12">
                                          <form class="user" enctype="multipart/form-data" action="{{ route('cohort.update', ['cohort' => $cohort->id])}}" method="POST">
                                              @csrf
                                              @method('PATCH')
                                                  <div class="form-group row">
                                                  <div class="col-sm-12">
                                                      <a href="javascript:void(0)">
                                                          <img id="updateCommitteeImage_m_{{$cohort->id}}" onclick="document.querySelector('#updateCommitteeLogo_m_{{$cohort->id}}').click()" class="img-profile rounded-circle d-block m-auto" style="height: 150px; width: 150px" src="{{ asset('' . $cohort->image) ?? asset('storage/default/avatar.png')}}">
                                                      </a>
                                                      <input type="file" name="image" class="form-control form-control-user d-none @error('image') is-invalid @enderror" id="updateCommitteeLogo_m_{{$cohort->id}}" placeholder="Logo">
                                                      @error('image')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                      @enderror
                                                      <input type="hidden" name="category" value="committee">
                                                      <input type="hidden" name="img" value="{{$cohort->image}}">
                                                  </div>
                                                  <div class="col-sm-12 mt-3 mb-sm-0">
                                                  <input type="text" name="name" value="{{old('name') ?? $cohort->name}}" class="form-control form-control-user  @error('name') is-invalid @enderror" id="updateCommitteeName_m_{{$cohort->id}}" placeholder="Name" required>
                                                  @error('name')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                                                  </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <div id="" class="col-sm-12 sample">
                                                      <textarea name="about"  cols="60" class="form-control form-control-user @error('about') is-invalid @enderror" id="updateCommitteeDescription_m_{{$cohort->id}}" required>{{old('about') ?? $cohort->about}}</textarea>
                                                      @error('about')
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
                      <?php $ministry = 1 ?>
                  @endif
              @endforeach
            @endif
            @if ($ministry == 0)
              <tr class="odd">
                  <td>No Committee Found</td>
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
            new nicEditor({fullPanel : true}).panelInstance('newCommitteeDescription');
            for (let index = 0; index < mCategory.length; index++) {
                const element = mCategory[index].id;
                new nicEditor({fullPanel : true}).panelInstance(`updateCommitteeDescription_${element}`);

                document.querySelector(`#updateCommitteeDescription_${element}`).previousSibling.firstChild.addEventListener('input', function(){
                    document.querySelector(`#updateCommitteeDescription_${element}`).value = this.innerHTML;
                })

                //show chosen logo
                $(`#updateCommitteeLogo_${element}`).change(function() {
                    var reader = new FileReader();
                    reader.onload = function(){
                        let dataUrl = reader.result
                        document.querySelector(`#updateCommitteeImage_${element}`).src = dataUrl
                    }

                    let file = $(`#updateCommitteeLogo_${element}`).prop('files')[0]
                    reader.readAsDataURL(file)
                })
            }
            // new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
            // new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
            // new nicEditor({maxHeight : 100}).panelInstance('area5');
        });

        $(document).ready(() => {
            document.querySelector('#newCommitteeDescription').previousSibling.firstChild.addEventListener('input', function(){
                document.querySelector('#newCommitteeDescription').value = this.innerHTML;
                // alert('working')
            })

            //show chosen logo
            $('#newCommitteeLogo').change(function() {
                var reader = new FileReader();
                reader.onload = function(){
                    let dataUrl = reader.result
                    document.querySelector('#newCommitteeImage').src = dataUrl
                }

                let file = $('#newCommitteeLogo').prop('files')[0]
                reader.readAsDataURL(file)
            })

            var nicEdit = $('.sample').children()
            for (let i = 0; i < nicEdit.length; i++) {
              let element = nicEdit[i];
              element.style.width = "100%"
              let innerNicEdit = element.children
              if (innerNicEdit != null) {
                for (let j = 0; j < innerNicEdit.length; j++) {
                  let e = innerNicEdit[j];
                  e.style.width = "inherit"
                }
              }
            }

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
