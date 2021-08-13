@extends('layouts.app')

@section('content')
    @parent

    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>Update a user</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-5 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="myh">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <br />
                                        @endif
                                        @if (!empty($success))
                                            <div class="alert alert-success">
                                                {{ $success }}
                                            </div>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form method="POST" action="{{ route('update-user') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input id="password" type="password" class="form-control" name="password"
                                            autocomplete="off" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Password confirmation:</label>
                                        <input id="password_confirmation" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="off" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
