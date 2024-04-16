@extends('web.layout.master')

@section('content')
    <section class="section wb mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            
                            <div class="col-md-6 offset-md-3">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="" class="form-wrapper" method="post">
                                    @csrf
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <button type="submit" class="btn btn-primary">Login </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection