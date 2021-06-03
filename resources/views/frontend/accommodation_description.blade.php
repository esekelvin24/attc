@extends('../layouts.frontend')


@section('title-name')
Accommodation Description
@endsection

@section('content')


    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area shadow dark bg-fixed text-center text-light" style="background-image: url({{asset('frontend/assets/img/banner/30.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Accommodation</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="{{url('/accommodation')}}"><i class="fas fa-home"></i> Accommodation</a></li>
                        <li class="active">{{$accommodation_details[0]->accommodation_name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <style>

                                    /* Useful Classes */
                                    .xy-center {
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                    }

                                    .transition {
                                        transition: all 350ms ease-in-out;
                                    }

                                    .r-3-2 {
                                        width: 100%;
                                        padding-bottom: 66.667%;
                                        background-color: #ddd;
                                    }

                                    .image-holder {
                                        background-size: cover;
                                        background-position: center center;
                                        background-repeat: no-repeat;
                                    }

                                    /* Main Styles */
                                    .gallery-wrapper {
                                        position: relative;
                                        overflow: hidden;
                                    }

                                    .gallery {
                                        position: relative;
                                        white-space: nowrap;
                                        font-size: 0;
                                    }

                                    .item-wrapper {
                                        cursor: pointer;
                                        width: 23%; /* arbitrary value */
                                        display: inline-block;
                                        background-color: white;
                                    }

                                    .gallery-item { opacity: 0.5; }
                                    .gallery-item.active { opacity: 1; }

                                    .slider_controls {
                                        font-size: 40px;
                                        font-weight:600;
                                        border-top: none;
                                    }
                                    .move-btn {
                                        display: inline-block;
                                        width: 48%;
                                        border: none;
                                    color: #002147;
                                        background-color: transparent;
                                        padding: 0.2em 1.5em;
                                    }
                                    .move-btn:first-child {border-right: none;}
                                    .move-btn.left  { cursor: w-resize; }
                                    .move-btn.right { cursor: e-resize; }


                                .panel-body ol
                                {
                                    margin-top: 10px;
                                }
                                .panel-body ul {
                               
                                 padding: 0;
                                }
                               .panel-body li {
                                padding-left: 1.3em;
                                }
                              .panel-body ul li:before {
                                
                                font-family: FontAwesome;
                                display: inline-block;
                                 list-style-type: none; /* Remove bullets */
                                margin-left: -1.3em; /* same as padding-left set on li */
                                width: 1.3em; /* same as padding-left set on li */
                            
                                font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f105";
                                color:#002147;
                                top:6px;
                                position: relative;
                                top: 2px;
                                padding-right: 7px;
                                color: #002147;
                             }
                            </style>
    

    <!-- Start Blog
    ============================================= -->
    <div class="blog-area single full-blog left-sidebar full-blog default-padding">
        <div class="container">
            <div class="row">
                <div class="blog-items">
                    <div class="blog-content col-md-8">

                        <div class="single-item">
                            <div class="item">
                               

                                <div class="info">
                                    
                                    
                                    <div class="content">
                                       
                                        <h3>{{$accommodation_details[0]->accommodation_name}}</h3>
                                        
                                  
                                        <p>  {!! $accommodation_details[0]->accommodation_description !!} </p>
                                       
                                           <div class="course-list-items acd-items acd-arrow">
                                            <div class="panel-group symb" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#ac1" aria-expanded="false" class="collapsed">
                                                                Facility
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="ac1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                        <div class="panel-body">
                                                          {!! $accommodation_details[0]->facility !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="course-list-items acd-items acd-arrow">
                                            <div class="panel-group symb" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#ac2" aria-expanded="false" class="collapsed">
                                                                 In Your Room
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="ac2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                        <div class="panel-body">
                                                            {!! $accommodation_details[0]->in_your_room !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="course-list-items acd-items acd-arrow">
                                            <div class="panel-group symb" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#ac3" aria-expanded="false" class="collapsed">
                                                                Shared Spaces
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="ac3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                        <div class="panel-body">
                                                           {!! $accommodation_details[0]->shared_space !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br/>
                                        <br/>
                                        <h4>How to apply</h4>
                                       <p>  Once you’ve decided where you’d like to live, simply <a href="#"><u>apply online</u></a>.</p>
                                    </div>
                                </div>

                                 <!-- Start Post Thumb -->
                                <div>
	
                                        <div class="feature">
                                            <figure class="featured-item image-holder r-3-2 transition"></figure>
                                        </div>
                                        
                                        <div class="gallery-wrapper">
                                            <div class="gallery">
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 active transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                                    <div class="item-wrapper">
                                                        <figure class="gallery-item image-holder r-3-2 transition"></figure>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        <div class="slider_controls">
                                            <button class="move-btn left">&larr;</button>
                                            <button class="move-btn right">&rarr;</button>
                                        </div>
                                        
                                    </div>
                                <!-- Start Post Thumb -->
                            </div>
                        </div>

                    </div>
                    <!-- Start Sidebar -->
                    <div class="sidebar col-md-4">
                        <aside>
                           <style>
                             
                           </style>
                          
                            <div s class="sidebar-item recent-post my_side_menu">
                                <ul>
                                    <li class="">
                                        <div class="info">
                                            <a class =" side_menu_padding " href="{{url('/accommodation')}}">Accommodation</a>
                                        </div>
                                    </li>
                                     @foreach($accommodation_list as $val)
                                    <li class=" {{$acc_id == $val->accommodation_id?'side_active':''}}">
                                        <div class="info">
                                            <a  class="side_menu_padding {{$acc_id == $val->accommodation_id?'my_link_active':''}}"  href="{{url('/accommodation/'.encrypt($val->accommodation_id))}}">{{$val->accommodation_name}}</a>
                                        </div>
                                    </li>
                                    @endforeach
                                   
                                </ul>
                            </div>
                            
                            </div>
                            
                        </aside>
                    </div>
                    <!-- End Start Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog -->

        <script>
        var gallery = document.querySelector('.gallery');
        var galleryItems = document.querySelectorAll('.gallery-item');
        var numOfItems = gallery.children.length;
        var itemWidth = 23; // percent: as set in css

        var featured = document.querySelector('.featured-item');

        var leftBtn = document.querySelector('.move-btn.left');
        var rightBtn = document.querySelector('.move-btn.right');
        var leftInterval;
        var rightInterval;

        var scrollRate = 0.2;
        var left;

        function selectItem(e) {
            if (e.target.classList.contains('active')) return;
            
            featured.style.backgroundImage = e.target.style.backgroundImage;
            
            for (var i = 0; i < galleryItems.length; i++) {
                if (galleryItems[i].classList.contains('active'))
                    galleryItems[i].classList.remove('active');
            }
            
            e.target.classList.add('active');
        }

        function galleryWrapLeft() {
            var first = gallery.children[0];
            gallery.removeChild(first);
            gallery.style.left = -itemWidth + '%';
            gallery.appendChild(first);
            gallery.style.left = '0%';
        }

        function galleryWrapRight() {
            var last = gallery.children[gallery.children.length - 1];
            gallery.removeChild(last);
            gallery.insertBefore(last, gallery.children[0]);
            gallery.style.left = '-23%';
        }

        function moveLeft() {
            left = left || 0;

            leftInterval = setInterval(function() {
                gallery.style.left = left + '%';

                if (left > -itemWidth) {
                    left -= scrollRate;
                } else {
                    left = 0;
                    galleryWrapLeft();
                }
            }, 1);
        }

        function moveRight() {
            //Make sure there is element to the leftd
            if (left > -itemWidth && left < 0) {
                left = left  - itemWidth;
                
                var last = gallery.children[gallery.children.length - 1];
                gallery.removeChild(last);
                gallery.style.left = left + '%';
                gallery.insertBefore(last, gallery.children[0]);	
            }
            
            left = left || 0;

            leftInterval = setInterval(function() {
                gallery.style.left = left + '%';

                if (left < 0) {
                    left += scrollRate;
                } else {
                    left = -itemWidth;
                    galleryWrapRight();
                }
            }, 1);
        }

        function stopMovement() {
            clearInterval(leftInterval);
            clearInterval(rightInterval);
        }

        leftBtn.addEventListener('mouseenter', moveLeft);
        leftBtn.addEventListener('mouseleave', stopMovement);
        rightBtn.addEventListener('mouseenter', moveRight);
        rightBtn.addEventListener('mouseleave', stopMovement);


        //Start this baby up
        (function init() {
            var images = [
                {!!$img_links!!}
            ];
            
            //Set Initial Featured Image
            featured.style.backgroundImage = 'url(' + images[0] + ')';
            
            //Set Images for Gallery and Add Event Listeners
            for (var i = 0; i < galleryItems.length; i++) {
                galleryItems[i].style.backgroundImage = 'url(' + images[i] + ')';
                galleryItems[i].addEventListener('click', selectItem);
            }
        })();
</script>

@endsection