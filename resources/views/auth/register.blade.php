@extends('layout.master')
@section('title', 'Register Page')
@section('content')
<div class="background pb-5 pt-5">
    <div class="container" style="width:700px">
        <div class="card" style="background: darkred; padding: 1rem">
            <form action="{{route('register')}}" method="post">
              @csrf
              <div class="mb-3  m-2">
                <h3 class="h3 text-light">Register</h3>
              </div>
              <div class="card-body">
                  <div class="mb-2 d-flex flex-column align-items-start">
                    <label for="name" class="form-label text-light">Name</label>
                    <input type="text" name ="name" class="form-control" id="name" placeholder="Your Name" value="{{old('name')}}">
                  </div>
                  <div class="mb-2 d-flex flex-column align-items-start">
                    <label for="email" class="form-label text-light">Email address</label>
                    <input type="email" name ="email" class="form-control" id="email" placeholder="johndoe@example.com" value="{{old('email')}}">
                  </div>
                  <div class="mb-2 d-flex flex-column align-items-start">
                    <label for="password" class="form-label text-light">Password</label>
                    <input type="password" name ="password"class="form-control" id="password" placeholder="8 - 20 Characters">
                  </div>
                  <div class="mb-2 d-flex flex-column align-items-start">
                    <label for="confirm" class="form-label text-light">Confirm Password</label>
                    <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Re-type your password">
                  </div>
                  <div class="mb-2 form-check d-flex justify-content-start gap-2">
                    <input class="form-check-input" type="checkbox" name="terms" value="0" id="terms">
                    <label class="form-check-label text-light" for="terms" name="terms">
                      I Agree To The Terms & Conditions.
                    </label>
                  </div>
                  <br>
                  <div class="mb-2">
                    @if ($errors->any())
                    <div class="alert alert-danger">{{$errors->first()}}</div>
                    @endif
                  </div>
                  <div class="mb-2">
                    <button type="submit" class="btn btn-light w-100">Register</button>
                  </div>
                </form>
                <hr>
                <p class="text-light">Already have an account ? Click <a class="link-light" href="/login"><u>Here</u></a> to Login.</p>
              </div>
        </div>
    </div>
</div>
@endsection
