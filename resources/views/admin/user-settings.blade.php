@extends('layouts.admin')
@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow mb-4 border-bottom-primary">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">User Image</h6>
                </div>
                <div class="card-body">
                    @if ($profile != null)
                <form class="user" enctype="multipart/form-data" action="{{ route('image.update', ['user' => Auth::user()->id])}}" method="POST">
                        @csrf
                        @method('PATCH')
                      <div class="form-group row">
                        <div class="col-12">
                            <a href="javascript:void(0)" class="d-block m-auto">
                                <img id="newUserImage" onclick="document.querySelector('#image').click()" class="img-profile rounded-circle d-block m-auto" style="height: 150px; max-width: 150px" src="{{ asset('' . $profile->image)}}">
                            </a>
                        <input type="file" name="image" class="form-control form-control-user d-none @error('image') is-invalid @enderror" id="image" required>
                          @error('image')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="col-12 mt-3 mb-sm-0">
                          <h5 class="text-center"><strong>{{ Auth::user()->username}}</strong></h5>
                        </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                          </div>
                      </div>
                    </form>

                    @else
                <form class="user" enctype="multipart/form-data" action="{{ route('image.store')}}" method="POST">
                        @csrf
                      <div class="form-group row">
                        <div class="col-12">
                            <a href="#" class="d-block m-auto">
                                <img id="newUserImage" onclick="document.querySelector('#image').click()" class="img-profile rounded-circle d-block m-auto" style="height: 150px; max-width: 150px" src="{{ asset('storage/default/avatar.png')}}">
                            </a>
                        <input type="file" name="image" class="form-control form-control-user d-none @error('image') is-invalid @enderror" id="image" required>
                          @error('image')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        <div class="col-12 mt-3 mb-sm-0">
                          <h5 class="text-center"><strong>{{ Auth::user()->username}}</strong></h5>
                        </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                          </div>
                      </div>
                    </form>
                    @endif


                </div>
              </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card shadow mb-4 border-bottom-primary">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Personal Details</h6>
              </div>
              <div class="card-body">
                @if ($profile != null)
                    <form class="user" action="{{ route('details.update', ['profile' => Auth::user()->id])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group row">
                        <div class="col-md-6 mb-sm-0">
                        <input type="text" name="fname" value="{{old('fname') ?? $profile->fname}}" class="form-control form-control-user p-3 @error('fname') is-invalid @enderror" id="fname" value="{{old('fname')}}" placeholder="First Name" required>
                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-sm-0">
                            <input type="text" name="lname" value="{{old('lname') ?? $profile->lname}}" class="form-control form-control-user p-3 @error('lname') is-invalid @enderror" id="lname" placeholder="Last Name" required>
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6 mb-sm-0">
                            <input type="text" name="sname" value="{{old('sname') ?? $profile->sname}}" class="form-control form-control-user p-3 @error('sname') is-invalid @enderror" id="sname" placeholder="Surname" required>
                            @error('sname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-sm-0">
                            <input type="date" name="dob" value="{{old('dob') ?? $profile->dob}}" class="form-control form-control-user pv-3 p-1 @error('dob') is-invalid @enderror" id="dob" title="Date Of Birth" required>
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6 mb-sm-0">
                            <input type="text" name="regno" value="{{old('regno') ?? $profile->regno}}" class="form-control form-control-user p-3 @error('regno') is-invalid @enderror" id="regno" placeholder="Registeration Number" required>
                            @error('regno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-sm-0">
                            <input type="text" name="course" value="{{old('course') ?? $profile->course}}" class="form-control form-control-user p-3 @error('course') is-invalid @enderror" id="course" placeholder="Course" required>
                            @error('course')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6">
                            <select name="sex" value="{{old('sex') ?? $profile->sex}}" id="sex" class="form-control form-control-user p-1 @error('sex') is-invalid @enderror" required>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('sex')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-sm-0">
                            <input type="date" name="doa" value="{{old('doa') ?? $profile->doa}}" class="form-control form-control-user p-1 pv-3 @error('doa') is-invalid @enderror" id="doa" title="Date Of Admission" required>
                            @error('doa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mt-3">
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                            </div>
                        </div>
                    </form>
                @else
                <form class="user" action="{{ route('details.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                    <div class="col-md-6 mb-sm-0">
                    <input type="text" name="fname" value="{{old('fname')}}" class="form-control form-control-user p-3 @error('fname') is-invalid @enderror" id="fname" value="{{old('fname')}}" placeholder="First Name" required>
                    @error('fname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="col-md-6 mb-sm-0">
                        <input type="text" name="lname" value="{{old('lname')}}" class="form-control form-control-user p-3 @error('lname') is-invalid @enderror" id="lname" placeholder="Last Name" required>
                        @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-6 mb-sm-0">
                        <input type="text" name="sname" value="{{old('sname')}}" class="form-control form-control-user p-3 @error('sname') is-invalid @enderror" id="sname" placeholder="Surname" required>
                        @error('sname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-sm-0">
                        <input type="date" name="dob" value="{{old('dob')}}" class="form-control form-control-user pv-3 p-1 @error('dob') is-invalid @enderror" id="dob" title="Date Of Birth" required>
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-6 mb-sm-0">
                        <input type="text" name="regno" value="{{old('regno')}}" class="form-control form-control-user p-3 @error('regno') is-invalid @enderror" id="regno" placeholder="Registeration Number" required>
                        @error('regno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-sm-0">
                        <input type="text" name="course" value="{{old('course')}}" class="form-control form-control-user p-3 @error('course') is-invalid @enderror" id="course" placeholder="Course" required>
                        @error('course')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-6">
                        <select name="sex" value="{{old('sex')}}" id="sex" class="form-control form-control-user p-1 @error('sex') is-invalid @enderror" required>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-sm-0">
                        <input type="date" name="doa" value="{{old('doa')}}" class="form-control form-control-user p-1 pv-3 @error('doa') is-invalid @enderror" id="doa" title="Date Of Admission" required>
                        @error('doa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mt-3">
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                        </div>
                    </div>
                </form>
                @endif
              </div>
            </div>
      </div>

      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow mb-4 border-bottom-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Contact Details</h6>
            </div>
            <div class="card-body">
                @if ($profile != null)

            <form class="user" action="{{ route('contacts.update', ['user' => Auth::user()->id])}}" method="POST">
                    @csrf
                    @method('PATCH')
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                    <input type="email" readonly value="{{ Auth::user()->email}}" class="form-control form-control-user p-3" id="userEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                    <input type="phone" name="phone" value="@if($profile != null){{$profile->phone}}@else {{ old('phone')}} @endif" class="form-control form-control-user p-3 @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" required>
                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6 mb-sm-0">
                    <input type="text" name="postalAddress" value="{{ old('postalAddress') ?? $profile->postalAddress}}" class="form-control form-control-user p-3 @error('postalAddress') is-invalid @enderror" id="postalAddress" placeholder="Postal Address" required>
                    @error('postalAddress')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="col-md-6 mb-sm-0">
                    <input type="text" name="postalCode" value="{{ old('postalCode') ?? $profile->postalCode}}" class="form-control form-control-user p-3 @error('postalCode') is-invalid @enderror" id="postalCode" placeholder="Postal Code" required>
                    @error('postalCode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-sm-0">
                    <input type="text" name="town" value="{{ old('town') ?? $profile->town}}" class="form-control form-control-user p-3 @error('town') is-invalid @enderror" id="town" placeholder="Town" required>
                    @error('town')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12 mt-3">
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                      </div>
                  </div>
                </form>

                @else
            <form class="user" action="{{ route('contacts.store')}}" method="POST">
                    @csrf
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                    <input type="email" readonly value="{{ Auth::user()->email}}" class="form-control form-control-user p-3" id="userEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                    <input type="phone" name="phone" value="{{ old('phone')}}" class="form-control form-control-user p-3 @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" required>
                      @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6 mb-sm-0">
                    <input type="text" name="postalAddress" value="{{ old('postalAddress')}}" class="form-control form-control-user p-3 @error('postalAddress') is-invalid @enderror" id="postalAddress" placeholder="Postal Address" required>
                    @error('postalAddress')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="col-md-6 mb-sm-0">
                    <input type="text" name="postalCode" value="{{ old('postalCode')}}" class="form-control form-control-user p-3 @error('postalCode') is-invalid @enderror" id="postalCode" placeholder="Postal Code" required>
                    @error('postalCode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 mb-sm-0">
                    <input type="text" name="town" value="{{ old('town')}}" class="form-control form-control-user p-3 @error('town') is-invalid @enderror" id="town" placeholder="Town" required>
                    @error('town')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-sm-12 mt-3">
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Update">
                      </div>
                  </div>
                </form>

                @endif

            </div>
          </div>
    </div>

    <div class="col-xl-12 col-md-6 mb-4">
      <div class="card shadow mb-4 border-bottom-primary">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Church Cohorts</h6>
          </div>
          <div class="card-body">
            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                <thead>
                  <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 55px;">Image</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Name</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 66px;">Contact</th>
                      <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 31px;">Actions</th>
                </thead>
                <tfoot>
                  <tr>
                      <th rowspan="1" colspan="1">Image</th>
                      <th rowspan="1" colspan="1">Name</th>
                      <th rowspan="1" colspan="1">Contact</th>
                      <th rowspan="1" colspan="1">Action</th>
                  </tr>
                </tfoot>
                <tbody>
                    <?php $contact = 'N/A'; $membershipStatus = 0; $leaderId = ''; $memberRight = 'no'?>
                    @if ($cohorts != null && count($cohorts) > 0)
                        @foreach ($cohorts as $cohort)
                            <tr id="m1" role="row" class="odd m-category">
                                <td class="sorting_1">
                                <img class="img-profile rounded-circle d-block m-auto" style="height: 50px; width: 50px" src="{{ asset('' . $cohort->image)}}">
                                </td>
                            <td>{{$cohort->name}} {{$cohort->category}}</td>
                                @if ($cohort->membership != null)
                                    @foreach ($cohort->membership as $leader)
                                        @if ($leader->post == 'chairperson')
                                            <?php $contact = $leader->user->profile->phone;?>
                                        @else

                                        @endif
                                    @endforeach
                                @else

                                @endif
                                <td>{{$contact}}</td>
                                <td>
                                    <div class="d-flex">
                                        @if ($cohort->membership != null)
                                            @foreach ($cohort->membership as $member)
                                                @if ($member->user_id == Auth::user()->id && $member->right == 'yes')
                                                {{-- $member->post == 'member' &&  --}}
                                                    <?php $membershipStatus = 1; $leaderId = $member->id; ?>
                                                @endif
                                                <?php $memberRight = $member->right ?>
                                            @endforeach
                                        @endif
                                        @if ($membershipStatus > 0 && $memberRight == 'yes')
                                            <form action="{{route('member.delete', ['cohort' => $cohort->id, 'member' => $leaderId])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="right" value="no">
                                                <input type="hidden" name="post" value="member">
                                                <button  type="submit" class="btn btn-success btn-icon-split">
                                                    <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                    </span>
                                                <span class="text">Joined</span>
                                                </button>
                                            </form>
                                        @elseif($memberRight == 'request')
                                            <form action="javascript:void(0)" method="post">
                                                @csrf
                                                <input type="hidden" name="cohort_id" value="{{$cohort->id}}">
                                                <input type="hidden" name="username" value="{{Auth::user()->username}}">
                                                <input type="hidden" name="right" value="yes">
                                                <input type="hidden" name="post" value="member">
                                                <input type="hidden" name="control" value="controler">
                                                <button type="submit" class="btn btn-secondary btn-icon-split" disabled>
                                                    <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                    </span>
                                                <span class="text">Pending</span>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{route('leader.store')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="cohort_id" value="{{$cohort->id}}">
                                                <input type="hidden" name="username" value="{{Auth::user()->username}}">
                                                <input type="hidden" name="right" value="request">
                                                <input type="hidden" name="post" value="member">
                                                <input type="hidden" name="control" value="controler">
                                                <button type="submit" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                    <i class="fas fa-info-circle"></i>
                                                    </span>
                                                <span class="text">Join</span>
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr role="row" class="odd"><td>No Cohort Found</td></tr>
                    @endif

                </tbody>
              </table>
          </div>
        </div>
  </div>
    </div>
@endsection

@section('nicEdit')
    <script type="text/javascript">

        var mCategory = $('.m-category');

        bkLib.onDomLoaded(function() {
            // new nicEditor().panelInstance('area1');
            // new nicEditor({fullPanel : true}).panelInstance('newGalleryDescription');
            for (let index = 0; index < mCategory.length; index++) {
                const element = mCategory[index].id;
                // new nicEditor({fullPanel : true}).panelInstance(`updateGalleryDescription_${element}`);

                // document.querySelector(`#updateGalleryDescription_${element}`).previousSibling.firstChild.addEventListener('input', function(){
                //     document.querySelector(`#updateGalleryDescription_${element}`).value = this.innerHTML;
                // })

                //show chosen logo
                $(`#updateGalleryLogo_${element}`).change(function() {
                    var reader = new FileReader();
                    reader.onload = function(){
                        let dataUrl = reader.result
                        document.querySelector(`#updateGalleryImage_${element}`).src = dataUrl
                    }

                    let file = $(`#updateGalleryLogo_${element}`).prop('files')[0]
                    reader.readAsDataURL(file)
                })
            }
            // new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
            // new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
            // new nicEditor({maxHeight : 100}).panelInstance('area5');
        });

        $(document).ready(() => {
            // document.querySelector('#newGalleryDescription').previousSibling.firstChild.addEventListener('input', function(){
            //     document.querySelector('#newGalleryDescription').value = this.innerHTML;
            //     // alert('working')
            // })

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

            // var nicEdit = $('.sample').children()
            // for (let i = 0; i < nicEdit.length; i++) {
            //   let element = nicEdit[i];
            //   element.style.width = "100%"
            //   let innerNicEdit = element.children
            //   if (innerNicEdit != null) {
            //     for (let j = 0; j < innerNicEdit.length; j++) {
            //       let e = innerNicEdit[j];
            //       e.style.width = "inherit"
            //     }
            //   }
            // }

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
