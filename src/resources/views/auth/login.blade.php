@extends('auth.base')

@section('content')
    <div class="d-flex justify-content-center align-items-center h-100">
        <form action="{{ route('login') }}" method="post" class="w-25">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h1 class="display-6">Login</h1>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-primary">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
