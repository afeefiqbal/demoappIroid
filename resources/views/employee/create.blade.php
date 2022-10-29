@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               

                <div class="card-body">
                    <form action="{{route('employee.store')}}" enctype="multipart/form-data" method="POST">
              @csrf
                        <div class="form-row">
                            <div class="col-md-12 ">
                        
                                  <label for="validationServer03">First Name</label>
                                  <input type="text" class="form-control @if ($errors->has('first_name')) is-invalid @endif " id="first_name" value="{{old('first_name')}}" name="first_name" placeholder="name" required>
                                  @if ($errors->has('first_name'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('first_name') }}
                                  </div>
                                  @endif
                                  <label for="validationServer03">Last Name</label>
                                  <input type="text" class="form-control @if ($errors->has('last_name')) is-invalid @endif " id="last_name" value="{{old('last_name')}}" name="last_name" placeholder="name" required>
                                  @if ($errors->has('last_name'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                  </div>
                                  @endif
                                  <label for="validationServer03">Company Name</label>
                                 <select name="company_id" id="company_id" class="form-control @if ($errors->has('last_name')) is-invalid @endif ">
                                  @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                  @endforeach
                                 </select>
                                  @if ($errors->has('company_id'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('company_id') }}
                                  </div>
                                  @endif
                                  <label for="validationServer04">Email</label>
                                  <input type="email" class="form-control  @if ($errors->has('email')) is-invalid @endif " id="email" name="email" value="{{old('email')}}" required>
                                  @if ($errors->has('email'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                  </div>
                                  @endif
                                  <label for="validationServer04">Phone</label>
                                  <input type="text" class="form-control  @if ($errors->has('phone')) is-invalid @endif " id="phone" name="phone" value="{{old('phone')}}" required>
                                  @if ($errors->has('phone'))
                                  <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                  </div>
                                  @endif
                            
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