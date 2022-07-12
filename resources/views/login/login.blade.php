@extends("layout.masterForm")
@section("form")

          <div class="col-lg-5 mx-auto">
            <div>
            <img style="max-height: 200px; display: block; margin: auto; width: 60%;" src="{{url("/asset/img/logo/logo.png")}}">
          </div>
            <h4 class="text-center mb-4">Sales And Inventory System</h4>
            <div class="auto-form-wrapper">

                  @if(\Session::has("alert"))
                      <div class="alert alert-danger">
                          <div>{{Session::get("alert")}}</div>
                      </div>
                          @endif

               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              
              @if(\Session::has("alert-success"))
                  <div class="alert alert-success">
                      <div>{{Session::get("alert-success")}}</div>
                  </div>
              @endif

                <form action="{{url("/loginPost")}}" method="POST" enctype="multipart/form-data">          
                  {{ csrf_field() }}
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input autofocus="" autocomplete="off" type="text" class="form-control" name="username" placeholder="Username">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input autocomplete="off" type="password" class="form-control" name="password" placeholder="*********">
                    <div class="input-group-append">                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" type="submit">Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="#" class="text-small forgot-password text-black">Forgot Password</a> -->
                </div>
                <!-- <div class="form-group">
                  <button class="btn btn-block g-login">
                    <img class="mr-3" src="/asset/images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                </div> -->
                <!-- < --><!-- div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.html" class="text-black text-small">Create new account</a>
                </div> -->
              </form>
            </div>
          </div>
@endsection