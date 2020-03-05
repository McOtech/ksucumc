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
                    <div class="form-group row">
                    <div class="col-12">
                        <img id="newUserImage" onclick="document.querySelector('#newUserImageFile').click()" class="img-profile rounded-circle d-block m-auto" style="height: 150px; max-width: 150px" src="@if($profile != null) {{asset('' . $profile->image)}} @else {{ asset('storage/default/avatar.png')}} @endif">
                    </div>
                    <div class="col-12 mt-1 text-center mb-sm-0">
                        <h5><strong>{{Auth::user()->username}}</strong></h5>
                    </div>
                    </div>
                </div>
              </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card shadow mb-4 border-bottom-primary">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Personal Details</h6>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                      <div class="col-12 mb-sm-0">
                        <span><strong>Name: </strong>@if($profile != null){{$profile->fname}}  {{$profile->lname}} {{$profile->sname}}@endif</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12 mb-sm-0">
                        <span><strong>Date Of Birth: </strong>@if($profile != null){{$profile->dob}}@endif</span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-12 mb-sm-0">
                        <span><strong>Registration Number: </strong>@if($profile != null){{$profile->regno}}@endif</span>
                      </div>
                    </div>
                      <div class="form-group row">
                        <div class="col-12 mb-sm-0">
                            <span><strong>Course: </strong>@if($profile != null){{$profile->course}}@endif</span>
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-12 mb-sm-0">
                        <span><strong>Date of Admission: </strong>@if($profile != null){{$profile->doa}}@endif</span>
                      </div>
                    </div>
              </div>
            </div>
      </div>

      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card shadow mb-4 border-bottom-primary">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Contact Details</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                      <span><strong>Email: </strong>@if($profile != null){{$profile->user->email}}@endif</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                      <span><strong>Phone: </strong>@if($profile != null){{$profile->phone}}@endif</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                      <span><strong>Postal Address: </strong>@if($profile != null){{$profile->postalAddress}}@endif</span>
                    </div>
                  </div>
                    <div class="form-group row">
                      <div class="col-12 mb-sm-0">
                          <span><strong>Postal Code: </strong>@if($profile != null){{$profile->postalCode}}@endif</span>
                      </div>
                    </div>
                  <div class="form-group row">
                    <div class="col-12 mb-sm-0">
                      <span><strong>Town: </strong>@if($profile != null){{$profile->town}}@endif</span>
                    </div>
                  </div>
            </div>
          </div>
    </div>


    <div class="col-xl-4 col-md-4 mb-4">
      <div class="card shadow mb-4 border-bottom-primary">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Committees</h6>
          </div>
          <div class="card-body">
            <ol>
                @if($profile != null)
                    @foreach ($profile->user->membership as $member)
                        @if ($member->cohort != null)
                            @if ($member->cohort->category == 'committee' && $member->user_id == $profile->user->id && $member->right == 'yes')
                                <li><strong>{{$member->cohort->name}}</strong></li>
                            @endif
                        @endif
                    @endforeach
                @endif
            </ol>
          </div>
        </div>
  </div>

  <div class="col-xl-4 col-md-4 mb-4">
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Ministries</h6>
        </div>
        <div class="card-body">
          <ol>
            @if($profile != null)
                @foreach ($profile->user->membership as $member)
                    @if ($member->cohort != null)
                        @if ($member->cohort->category == 'ministry' && $member->user_id == $profile->user->id && $member->right == 'yes')
                            <li><strong>{{$member->cohort->name}}</strong></li>
                        @endif
                    @endif
                @endforeach
            @endif
          </ol>
        </div>
      </div>
</div>

<div class="col-xl-4 col-md-4 mb-4">
  <div class="card shadow mb-4 border-bottom-primary">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Boards</h6>
      </div>
      <div class="card-body">
        <ol>
            @if($profile != null)
                @foreach ($profile->user->membership as $member)
                    @if ($member->cohort != null)
                        @if ($member->cohort->category == 'board' && $member->user_id == $profile->user->id && $member->right == 'yes')
                            <li><strong>{{$member->cohort->name}}</strong></li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ol>
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
            $('#newUserImageFile').change(function() {
                var reader = new FileReader();
                reader.onload = function(){
                    let dataUrl = reader.result
                    document.querySelector('#newUserImage').src = dataUrl
                }

                let file = $('#newUserImageFile').prop('files')[0]
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
