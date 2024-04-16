@extends('admin.layout.master')

@section('title')
    Tạo tài khoản
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>Add</small>
                    </h1>
                    @if (count($errors))
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{ $err }} <br>
                        @endforeach
                    </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Name" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirm" placeholder="Please Enter Password" />
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <label class="radio-inline">
                                <input name="is_admin" value="0" checked type="radio">User
                            </label>
                            <label class="radio-inline">
                                <input name="is_admin" value="1" type="radio">Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Add</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection