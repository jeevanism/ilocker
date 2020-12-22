@if(isset($ggallery)) 
@foreach ($ggallery as $image)
<div class="col-lg-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
  <div class="box">
    <button type="button" name="imageid" value="{{$image->status}}" data-imageid="{{$image->id}}" class=" updatestatus btn btn-primary" id="imageid_{{$image->id}}">Change Privacy</button>
     <img src="{{url($image->path)}}" class="img-fluid img-thumbnail rounded mx-auto d-block" alt="Image" />
    <button type="button" name="imageid" value="{{$image->id}}" class="delete btn btn-primary btn-sm">Delete</button>
  </div>
</div> 
@endforeach 
@endif