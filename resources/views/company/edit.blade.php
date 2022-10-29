@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <form action="/admin/company/{{$data->id}}" enctype="multipart/form-data" method="post">
                    @method('PUT')
              @csrf
                        <div class="form-row">
                            <div class="col-md-12 ">
                        
                                  <label for="validationServer03">Name</label>
                                  <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif " id="name" value="{{$data->name}}" name="name" placeholder="name" required>
                                  @if ($errors->has('name'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                  </div>
                                  @endif
                       
                                  <label for="validationServer04">Email</label>
                                  <input type="email" class="form-control  @if ($errors->has('email')) is-invalid @endif " id="email" name="email" value="{{$data->email}}" required>
                                  @if ($errors->has('email'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                  </div>
                                  @endif
                                  <label for="validationServer04">Website</label>
                                  <input type="text" class="form-control  @if ($errors->has('website')) is-invalid @endif " id="website" name="website" value="{{$data->website}}" required>
                                  @if ($errors->has('website'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                  </div>
                                  @endif
                                <label for="validationServer04">logo</label>
                                <input type="file" class="form-control  @if ($errors->has('image')) is-invalid @endif" name="image" id="logo" placeholder="logo" >
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                  </div>
                            </div>
                         <br>
                        </div>
                   
                        <button class="btn btn-primary" type="submit">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection 