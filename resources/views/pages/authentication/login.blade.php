@extends('layouts.authentication')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header"> <a href="../index2.html"
                class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                <h1 class="mb-0"> <b>Praxxys</b>
                </h1>
            </a> </div>
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @error('invalid')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @enderror
            <form action="{{route('authentication.login')}}" method="post">
                @csrf
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginUsername" type="text" class="form-control @error('username')
                            is-invalid
                        @enderror" name="username" value="{{old('username')}}" placeholder="">
                        <label for="loginUsername">Username</label>
                        <div class="invalid-feedback">
                            @error('username')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                </div>
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <input id="loginPassword" type="password" class="form-control @error('password')
                            is-invalid
                        @enderror" name="password" placeholder="">
                        <label for="loginPassword">Password</label>
                        <div class="invalid-feedback">
                            @error('password')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div> <!--begin::Row-->
                <div class="row">
                    <div class="col-8 d-inline-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember Me
                            </label>
                        </div>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
        </div> <!-- /.login-card-body -->
    </div>
@endsection
