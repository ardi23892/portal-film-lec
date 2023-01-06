@extends('layout.master')
@section('title', 'Edit Password')
@section('content')
<div class="background p-5" style="height: 86vh">
    <div class="container" style="width:700px">
        <div class="card" style="background: darkred; padding: 1rem">
            <form action="{{route('edit_password')}}" method="post">
                @csrf
                <div class="mb-3  m-2">
                  <h3 class="h3 text-light">Change Password</h3>
                </div>
                <div class="card-body">
                    <div class="mb-2 d-flex flex-column align-items-start">
                        <label for="new-password" class="form-label text-light">New Password</label>
                        <input type="password" name ="new-password"class="form-control" id="password" placeholder="New Password (8-20)">
                    </div>
                    <div class="mb-2 d-flex flex-column align-items-start">
                        <label for="confirm" class="form-label text-light">Confirm new Password</label>
                        <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Re-type your password">
                    </div>
                    <div class="mb-2 d-flex flex-column align-items-start">
                        <label for="password" class="form-label text-light">Password</label>
                        <input type="password" name ="password"class="form-control" id="password" placeholder="Input your old password">
                    </div>

                    <div class="mb-2">
                    @if ($errors->any())
                      <div class=" alert alert-danger">{{$errors->first()}}</div>
                    @endif
                    </div>
                    <br>
                    <div class="mb-2">
                    <button type="submit" class="btn btn-light w-100">Confirm</button>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
