@extends('web.layout.master')

@section('title')
    Contact Us
@endsection

@section('content')
    <section class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-wrapper">
                        <div class="row">
                            
                            <div class="col-lg-5">
                                <h4>Who we are</h4>
                                <p>Tech Blog is a personal blog for handcrafted, cameramade photography content, fashion styles from independent creatives around the world.</p>
                
                                <h4>How we help?</h4>
                                <p>Etiam vulputate urna id libero auctor maximus. Nulla dignissim ligula diam, in sollicitudin ligula congue quis turpis dui urna nibhs. </p>
            
                                <h4>Pre-Sale Question</h4>
                                <p>Fusce dapibus nunc quis quam tempor vestibulum sit amet consequat enim. Pellentesque blandit hendrerit placerat. Integertis non.</p>
                            </div>
                            <div class="col-lg-7">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('web.contact.store') }}" class="form-wrapper" method="post">
                                    @csrf
                                    <input type="text" name="name" class="form-control" placeholder="Your name">
                                    <input type="text" name="address" class="form-control" placeholder="Email address">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject">
                                    <textarea class="form-control" name="message" placeholder="Your message"></textarea>
                                    <button type="submit" class="btn btn-primary">Send <i class="fa-solid fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection