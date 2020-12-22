@extends('layouts.app')
 @section('content')
<section id="about" class="about section-bg">
    <div class="container-fluid min-vh-100 aos-init aos-animate" data-aos="fade-up">
        <div class="section-title">
            <h2>Upload Image</h2>
            <p>Please select image to upload, only jpeg, jpg, png files and size below 2MB</p>
        </div>
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">{{ __('Please select the image to upload') }}</div>
                <div class="card-body">
                 @if (session('status'))
                    <div class="alert alert-success" role="alert"> {{ session('status') }} </div>
                     @endif
                      @if (count($errors) > 0)
                    <div class="alert alert-danger"> <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                         @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                             @endforeach </ul>
                    </div>
                     @endif
                    <form method="POST" enctype="multipart/form-data" action="{{ route('upload') }}">
                     @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="imgInput">{{ __('Select Image') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" name="image" id="imgInput"> @error('imgInput') <span class="invalid-feedback" role="alert">
                                        <strong>{{ $imgInput ?? '' }}</strong>
                                    </span>
                                 @enderror </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"> {{ __('Upload') }} </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<div class="row justify-content-center">
    <div class="col-md-8"> </div>
</div> @endsection