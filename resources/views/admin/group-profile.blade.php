@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$cohort->name}} Profile</h1>
    </div>
    <div class="row">
        <!-- Mission Card Start -->
        <div class="col-lg-6">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
              <!-- Card Header - Dropdown -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Mission</h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Settings:</div>
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#mission">Edit</a>
                    {{-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a> --}}
                  </div>
                </div>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                {!!$cohort->about!!}
              </div>
            </div>

            <!-- Mission Update Modal-->
            <div class="modal fade" id="mission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Mission</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="user" action="{{route('cohort.update', ['cohort' => $cohort->id])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row">
                                        <div id="" class="col-sm-12 sample">
                                        <textarea name="about" cols="60" class="form-control form-control-user" id="editMissionDescription">{!! $cohort->about !!}</textarea>
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
                    </div>
                </div>
                </div>
            </div>

            {{-- <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
              <!-- Card Header - Accordion -->
              <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
              </a>
              <!-- Card Content - Collapse -->
              <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                  This is a collapsable card example using Bootstrap's built in collapse functionality. <strong>Click on the card header</strong> to see the card body collapse and expand!
                </div>
              </div>
            </div> --}}

          </div>
          <div class="col-md-6">
              <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Policy</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Settings:</div>
                      <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#policy">Edit</a>
                      {{-- <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a> --}}
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <iframe src="@if($cohort->policy == null) {{ asset('storage/default/avatar.png')}} @else {{asset($cohort->policy)}} @endif" class="w-100" style="height: 25em;" frameborder="0"></iframe>
                </div>
              </div>
              <!-- Policy Update Modal-->
              <div class="modal fade" id="policy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Mission</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                      </div>
                      <div class="modal-body">
                          <div class="container">
                          <div class="row">
                              <div class="col-sm-12">
                                  <form class="user" enctype="multipart/form-data" action="{{route('cohort.update', ['cohort' => $cohort->id])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-sm-0">
                                          <input type="file" name="policy" class="form-control form-control-user" id="newPolicyFile">
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
                      </div>
                  </div>
                  </div>
              </div>
          </div>
        <!-- Mission Card End -->
@endsection

@section('nicEdit')
    <script type="text/javascript">

        var mCategory = $('.m-category');

        bkLib.onDomLoaded(function() {
            // new nicEditor().panelInstance('area1');
            new nicEditor({fullPanel : true}).panelInstance('editMissionDescription');
            // for (let index = 0; index < mCategory.length; index++) {
            //     const element = mCategory[index].id;
            //     // new nicEditor({fullPanel : true}).panelInstance(`updateGalleryDescription_${element}`);

            //     // document.querySelector(`#updateGalleryDescription_${element}`).previousSibling.firstChild.addEventListener('input', function(){
            //     //     document.querySelector(`#updateGalleryDescription_${element}`).value = this.innerHTML;
            //     // })

            //     //show chosen logo
            //     $(`#updateGalleryLogo_${element}`).change(function() {
            //         var reader = new FileReader();
            //         reader.onload = function(){
            //             let dataUrl = reader.result
            //             document.querySelector(`#updateGalleryImage_${element}`).src = dataUrl
            //         }

            //         let file = $(`#updateGalleryLogo_${element}`).prop('files')[0]
            //         reader.readAsDataURL(file)
            //     })
            // }
        });

        $(document).ready(() => {
            document.querySelector('#editMissionDescription').previousSibling.firstChild.addEventListener('input', function(){
                document.querySelector('#editMissionDescription').value = this.innerHTML;
                // alert('working')
            })

            // //show chosen logo
            // $('#newGalleryLogo').change(function() {
            //     var reader = new FileReader();
            //     reader.onload = function(){
            //         let dataUrl = reader.result
            //         document.querySelector('#newGalleryImage').src = dataUrl
            //     }

            //     let file = $('#newGalleryLogo').prop('files')[0]
            //     reader.readAsDataURL(file)
            // })

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

