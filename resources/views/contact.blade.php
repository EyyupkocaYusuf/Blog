@extends('front.layouts.master')
@section('title','iletisim')
@section('bg','https://www.torrentshotcrete.com/wp-content/uploads/2018/01/Contact_Us_Bkgrd.jpg')
@section('content')
    <!-- Main Content-->
    <!-- Post preview-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
                    <div class="my-5">
                        <form method="post" action="{{route('contact.post')}}">
                            @csrf
                            <div class="control-group">
                            <div class="form-group controls">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{old('name')}}" type="text" placeholder="Enter your name..."  required />
                                <p class="help-block text-danger"></p>
                            </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group controls">
                                    <label>Mail</label>
                                    <input class="form-control" name="email" value="{{old('email')}}" type="email" placeholder="Enter your email..."  required />
                                </div>
                            </div>
                            <br/>
                            <div class="control-group">
                                <div class="form-group controls">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" value="{{old('phone')}}" type="text" placeholder="Enter your phone..."  required />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group controls">
                                    <label>Subject</label>
                                    <input class="form-control" name="subject" value="{{old('subject')}}" type="text" placeholder="Enter your subject..."  required />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group controls">
                                    <label>Message</label>
                                    <input class="form-control" name="message" value="{{old('message')}}" type="text" placeholder="Enter your message..."  required />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />

                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>

                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>

                            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection





