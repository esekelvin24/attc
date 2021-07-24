@extends('../layouts.frontend')


@section('title-name')
Contact
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/13.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Contact Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                       
                        <li class="active">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->
   
    <!-- Start Contact Info
    ============================================= -->
    <div class="contact-info-area default-padding">
        <div class="container">
            <!-- Start Contact Info -->
            <div class="contact-info text-center">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="icon">
                                <i class="flaticon-call"></i>
                            </div>
                            <div class="info">
                                <h4>Call Us</h4>
                                <span>+234 09014067496 | 08118052403 | 07038260210</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="icon">
                                <i class="flaticon-location"></i>
                            </div>
                            <div class="info">
                                <h4>Address</h4>
                                <span>6, OSENI CLOSE, MAGBON SEGUN BUS STOP, DANGOTE REFINERY NEW GATE, IBEJU LEKKI, LAGOS</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item">
                            <div class="icon">
                                <i class="flaticon-email"></i>
                            </div>
                            <div class="info">
                                <h4>Email Us</h4>
                                <span>info@attcnigeria.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Contact Info -->
            
            <div class="row contact-bottom-info">
                <!-- Start Maps & Contact Form -->
                <div class="maps-form">
                    <div class="col-md-6 maps">
                        <h4>Our Location</h4>
                        <img src="{{asset('frontend/assets/img/contact/contact.jpg')}}" alt="Thumb">
                    </div>
                    <div class="col-md-6 form">
                        <div class="heading">
                            <h4>Contact Us</h4>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{url('submit_contact_form')}}" method="POST" >
                         @csrf
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input value="{{old('name')}}" required class="form-control" id="name" name="name" placeholder="Name" type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input value="{{old('email')}}" required class="form-control" id="email" name="email" placeholder="Email*" type="email">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <input value="{{old('phone')}}" required class="form-control" id="phone" name="phone" placeholder="Phone" type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group comments">
                                        <textarea required class="form-control" id="comments" name="comments" placeholder="Tell Me About Courses *">{{old('comments')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @if(config('services.recaptcha.key'))
                                        <div class="g-recaptcha"
                                            data-sitekey="{{config('services.recaptcha.key')}}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row">
                                     <br/>
                                    <button type="submit" >
                                        Send Message <i class="fa fa-paper-plane"></i>
                                    </button>

                                </div>
                            </div>
                          
                        </form>
                    </div>
                </div>
                <!-- End Maps & Contact Form -->

            </div>
        </div>
    </div>
    <!-- End Contact Info -->
@endsection
@section('additional_js')
<script>
  
@if(Session::get('contact_success'))

     Swal.fire('Success','{{Session::get("contact_success")}}','success');
      

@endif

</script>

@endsection