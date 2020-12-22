@extends(isset(Auth::user()->id) ? 'layouts.app' : 'layouts.index') @section('content')
 

<section id="portfolio" class="portfolio">
  <div class="container aos-init aos-animate" data-aos="fade-up">
    <div class="section-title">
      <h2>Public Images</h2> 
              @auth
           
      <p>You can manage your image privacy in 
        <a href="{{url('ajaxupdate/'.Auth::user()->id)}}">My Uploads</a>
      </p> 
            @endauth 
        
    </div>

         @if(count($gallery) >= 1)
    
          
    <div class="row">
             @foreach ($gallery as $image)  

  
      <div class="col-lg-3 col-md-3 col-sm-3">
        <img class="img-responsive"
                   src="{{url($image->path)}}" />
        <div class="member">
          <div class="member-info">
            <span>Uploaded at: {{$image->created_at}}</span>
          </div>
        </div>
      </div>
 @endforeach 

    </div>
      

          @else
    
    <div class="section-title">
      <h2>No Public Images</h2>
    </div> 
    @endif 
  
  </div>
</section>

@endsection