@extends('layout.master')
@section('title', 'Login Page')
@section('content')
<div class="background p-5" style="height: 86vh">
    <div class="container" style="width:700px">
        <div class="card" style="background: darkred; padding: 1rem">
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="mb-3  m-2">
                  <h3 class="h3 text-light">Sign in</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2 d-flex flex-column align-items-start">
                        <label for="email" class="form-label text-light">Email address</label>
                        <input type="email" name ="email" class="form-control" id="email" placeholder="name@example.com" value="{{old('email')}}">
                      </div>
                      <div class="mb-2 d-flex flex-column align-items-start">
                        <label for="password" class="form-label text-light">Password</label>
                        <input type="password" name ="password" class="form-control" id="password" placeholder="8 - 20 Characters">
                      </div>
                      <div class="mb-2 form-check d-flex justify-content-start gap-2">
                        <input class="form-check-input" type="checkbox" name="remember" value="" id="remember">
                        <label class="form-check-label text-light" for="remember">
                          Remember Me
                        </label>
                      </div>
                      <div class="mb-2">
                        @if ($errors->any())
                          <div class=" alert alert-danger">{{$errors->first()}}</div>
                        @endif
                      </div>
                      <div class="mb-2">
                        <button type="submit" class="btn btn-light w-100">Login</button>
                      </div>
                    </form>
                    <hr>
                    <p class="text-light">Don't Have an Account Yet ? Click <a class="link-light" href="/register"><u>Here</u></a> to Register.</p>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
