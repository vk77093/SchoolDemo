@extends('auth.authLayouts.authMain')
@section('main')
    

<div class="col-12">
    <div class="row justify-content-center no-gutters">
        <div class="col-lg-4 col-md-5 col-12">
            <div class="content-top-agile p-10">
                <h2 class="text-white">Get started with Us</h2>
                <p class="text-white-50">Register a new membership</p>							
            </div>
            <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                <x-jet-validation-errors class="mb-4 text-danger" />
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Full Name" name="name" value="{{old('name')}}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent text-white"><i class="ti-email"></i></span>
                            </div>
                            <input type="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Email" name="email" value="{{old('email')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password" name="password" value="{{old('password')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Retype Password" value="{{old('password_confirmation')}}" name="password_confirmation" required>
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="checkbox text-white">
                            <input type="checkbox" id="basic_checkbox_1" >
                            <label for="basic_checkbox_1">I agree to the <a href="#" class="text-warning"><b>Terms</b></a></label>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-info btn-rounded margin-top-10">Regiset and Sign In</button>
                        </div>
                        <!-- /.col -->
                      </div>
                </form>													

                <div class="text-center text-white">
                  <p class="mt-20">- Register With -</p>
                  <p class="gap-items-2 mb-20">
                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>
                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>
                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>
                      <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>
                    </p>	
                </div>

                <div class="text-center">
                    <p class="mt-15 mb-0 text-white">Already have an account?<a href="{{ route('home') }}" class="text-danger ml-5"> Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>	
@endsection