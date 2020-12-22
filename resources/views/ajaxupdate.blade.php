@extends('layouts.app')
@section('content')
<section id="pricing" class="pricing">
  <div class="container-fluid min-vh-100 aos-init aos-animate" data-aos="fade-up">
    <div class="section-title">
      <h2>My Uploads</h2>
      <p>You can change privacy or delete images</p>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="{{route('home')}}">
              <button type="button" class="btn btn-success">Upload a New Image to Locker</button>
            </a>
          </div>
          <div class="card-body"> 
            {{$data ?? ''}} @auth @if (session('status'))
            <div class="alert alert-success" role="alert"> 
              {{ session('status') }} </div> 
            @endif 
            @endauth 

            @guest
            <p>Please login to view your locker</p> 
            @endguest

            <div id="msg" style="display:none" class="alert alert-success alert-block"></div> 

            @if ($message = Session::get('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{ $message }}</strong> => <strong> {{ Session::get('image')}}</strong>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>

            </div> 
            @endif 
            @auth 
            @if(isset($gallery) && count($gallery) >= 1 && $user_id == Auth::user()->id)
            <div id="ajaxdiv" class="row"> 
              @foreach ($gallery as $image)
              <div class="col-lg-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="box">
                  <button type="button" name="imageid" value="{{$image->status}}" data-imageid="{{$image->id}}" class=" updatestatus btn btn-primary btn-sm" id="imageid_{{$image->id}}">Change Privacy</button> <img src="{{url($image->path)}}" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="Image" />
                  <button type="button" name="imageid" value="{{$image->id}}" class="delete btn btn-danger btn-sm">Delete</button>
                </div>
              </div> 
            @endforeach 
          </div> 
          @else
            <p>No Images available for you</p> 
          @endif 
        @endauth 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
  $('body').on('click', '.updatestatus', function() {
    var updatestatus = $(this).val();
    var imageid = $(this).attr('data-imageid');
    var _token = $('meta[name="csrf-token"]').attr('content');
     $.ajax({
      cache: false,
      async: "false",
      url: "{{ url('ajaxupdate')}}",
      type: "POST",
      
      data: {
        imageid: imageid,
        updatestatus: updatestatus,
        _token: _token,
      },
      success: function(res) {
        
        $('#msg').html(res.data.imageName + " is changed to " + res.data.visible).fadeIn('slow');
        $('#msg').delay(3000).fadeOut('slow');
        $('#ajaxdiv').html(res.data.html);
      },
    });
  });
});
$('body').on('click', '.delete', function() {
  var deleteimg = $(this).val();
  var _token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    cache: false,
    async: "false",
    url: "{{ url('ajaxDelete')}}",
    type: "POST",
    data: {
      imageid: deleteimg,
      _token: _token,
    },
    success: function(res) {
     
      $('#msg').html(res.data.imageName + " is deleted !").fadeIn('slow');
      $('#msg').delay(3000).fadeOut('slow');
      $('#ajaxdiv').html(res.data.html);
    },
  });
  
});
</script>
</div>
@endsection