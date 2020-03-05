@extends('layouts.admin')
@section('content')
<!-- Page Heading-->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Photos</h1>
        <div class="mb-1 small h3 p-0 m-0">Progress...</div>
        <div class="col-6 progress small mb-2">
            <div id="found" class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

        <input type="hidden" name="username" id="username" value="{{Auth::user()->username}}">
        <input type="hidden" name="my-img" id="my-img" value="{{Auth::user()->profile->image}}">
    <input type="hidden" name="get-photos" id="get-photos" value="{{route('photo.index')}}">
    </div>
    <div id="photos" class="row">
        {{-- <div class="col-md-4">
            <div class="card mb-4 border-bottom-primary">
                <div class="card-body p-1">
                    <img src="{{asset('storage/1.png')}}" alt="me" style="width:100%; height: 12em" >
                </div>
              </div>
        </div> --}}
    </div>

@endsection

@section('faceapi')
    <script src="{{asset('face-api.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        const content = document.querySelector('#photos')
        const progress = document.querySelector('#found')
        var uri = location.href.split('/')
        const domain = `${uri[0]}//${uri[2]}`
        var progressCounter = 100;

        Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
            faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
            faceapi.nets.faceRecognitionNet.loadFromUri('/models')
            // faceapi.nets.faceExpressionNet.loadFromUri('/models')
        ]).then(start)

        var beginNote = `<div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body p-1">
                                    <h6> Start Of Recommended Photos....</h6>
                                </div>
                            </div>
                        </div>`

        var endNote = `<div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body p-1">
                                    <h6> End Of Recommended Photos....</h6>
                                </div>
                            </div>
                        </div>`

        async function start() {
            const labeledFaceDescriptors = await loadLabeledImages().then(async (labeledFaceDescriptors) => {
                const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
                content.innerHTML = beginNote

                const photoUrl = $('#get-photos').val()
                fetch(photoUrl).then(d => d.json()).then((data) => {
                    data.forEach((obj) => {
                        // console.log(obj.path)
                        const img = new Image()
                        img.src = `${domain}/${obj.path}`
                        img.onload = async function(){
                            // console.log("Image changed...")
                            // const image = await faceapi.bufferToImage(imageUpload.files[0]).then( async (image) => {
                                // content.append(image)
                                const detections = await faceapi.detectAllFaces(img).withFaceLandmarks().withFaceDescriptors().then(async (detections) => {
                                    // console.log("Done...")
                                    // console.log(`Total Faces: ${detections.length}`)
                                    const results = detections.map(d => faceMatcher.findBestMatch(d.descriptor))
                                    results.forEach((result, i) => {
                                        let name = result.toString().split(' ')
                                        if(name[0] != 'unknown'){
                                            let recommendedPhoto = `<div class="col-md-4">
                                                                        <div class="card mb-4 border-bottom-primary">
                                                                            <div class="card-body p-1">
                                                                                <img src="${img.src}" alt="me" style="width:100%; height: 12em" >
                                                                            </div>
                                                                        </div>
                                                                    </div>`
                                            --progressCounter
                                            // console.log(`Person: ${name[0]}: ${img.src}`)
                                            content.innerHTML += recommendedPhoto
                                        }
                                        // ++progressCounter
                                    })
                                // })
                            })
                            progress.style.width = `${progressCounter}%`
                        }
                    })

                })
            })

        }

        function loadLabeledImages() {
            const username = $('#username').val()
            const labels = [username]
            return Promise.all(
                labels.map(async (label) => {
                    const descriptions = []
                    console.log(`expected: ${label}`)
                    const myImgPath = $('#my-img').val()
                    // for(let i = 1; i <= 1; i++){
                        // let input = new Image()
                        let ref = `${domain}/${myImgPath}`
                        // input.src = ref
                        // input.onload = async function(){
                        //     console.log(input)
                        // }
                        const img = await faceapi.fetchImage(ref).then(async (img) => {
                            const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor().then(async (detections) => {
                                if(detections != undefined){
                                    descriptions.push(detections.descriptor)
                                    console.log(`real: ${label}`)
                                }
                            })
                        })
                    // }
                    return new faceapi.LabeledFaceDescriptors(label, descriptions)
                })
            )
        }
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
