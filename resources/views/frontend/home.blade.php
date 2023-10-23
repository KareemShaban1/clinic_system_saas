<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kari care </title>
    <!-- Page Icon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/img/heartbeat-solid.svg') }}" type="image/x-icon">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Custom Css File Link -->
    @if (App::getLocale() == 'en' || App::getLocale() == 'it')
        <link rel="stylesheet" href="{{ asset('frontend/home/css/style.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('frontend/home/css/rtl_style.css') }}">
    @endif

    <style>
        @keyframes fade-in-out {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        #animated-text {
            animation: fade-in-out 3s infinite;
            animation-delay: 1s;
            transition: opacity 0.5s;
        }
    </style>
</head>

<body>
    <!-- Header Section Starts -->
    <div class="header">
        <a href="#" class="logo"><i class="fas fa-heartbeat"></i> Kari care </a>
        <nav class="navbar">
            <a href="#home">{{ trans('frontend/home_trans.Home') }}</a>
            {{-- <a href="#services">{{ trans('frontend/home_trans.Services') }}</a> --}}
            <a href="#about">{{ trans('frontend/home_trans.About Us') }}</a>
            {{-- <a href="#doctors">{{ trans('frontend/home_trans.Doctors') }}</a> --}}
            <a href="#blogs">{{ trans('frontend/home_trans.Our_Blogs') }}</a>
            <a href="{{ URL::to('/patient/register') }}">{{ trans('frontend/home_trans.Register') }}</a>
            <a href="{{ URL::to('/patient/login') }}">{{ trans('frontend/home_trans.Log In') }}</a>


            <a href="{{ URL::to('/admin/login') }}">{{ trans('frontend/home_trans.Admin Panel') }}</a>



        </nav>
        <div id="menu-btn" class="fas fa-bars"></div>
    </div>
    <!-- Header Section End -->

    <!-- Home Section starts -->
    <section class="home" id="home">
        <div class="image">
            <img src="{{ asset('frontend/home/image/home-img.svg') }}" alt="home-img.svg">
        </div>
        <div class="content">
            <h3>{{ trans('frontend/home_trans.stay safe, stay healthy') }}</h3>
            {{-- <p>Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Rem Sed Autem Vero? Magnam, Est Laboriosam!</p> --}}
            <a href="#" class="btn">{{ trans('frontend/home_trans.contact us') }} <span
                    class="fas fa-chevron-left"></span> </a>
        </div>
    </section>
    <!-- Home Section End -->

    <!-- icons section starts  -->
    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-user-md"></i>
            <h3>1</h3>
            <p>{{ trans('frontend/home_trans.Numbers_Of_Doctors') }}</p>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <h3>{{ $patients }}</h3>
            <p>{{ trans('frontend/home_trans.Numbers_Of_Patients') }}</p>
        </div>

        <div class="icons">
            <i class="fas fa-notes-medical"></i>
            <h3>{{ $reservations }}</h3>
            <p>{{ trans('frontend/home_trans.Numbers_Of_Reservations') }}</p>
        </div>

    </section>
    <!-- icons section End  -->

    <!-- Service section Starts  -->
    {{-- <section class="services" id="services">
        <h1 class="heading">our <span>services</span></h1>
        <div class="box-container">
            <div class="box">
                <i class="fas fa-notes-medical"></i>
                <h3>free checkups</h3>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Ad, Omnis.</p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="box">
                <i class="fas fa-ambulance"></i>
                <h3>24/7 ambulance</h3>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Ad, Omnis.</p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="box">
                <i class="fas fa-user-md"></i>
                <h3>expert doctors</h3>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Ad, Omnis.</p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="box">
                <i class="fas fa-pills"></i>
                <h3>medicines</h3>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Ad, Omnis.</p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="box">
                <i class="fas fa-procedures"></i>
                <h3>bed facility</h3>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Ad, Omnis.</p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
            <div class="box">
                <i class="fas fa-heartbeat"></i>
                <h3>total care</h3>
                <p>Lorem Ipsum Dolor Sit Amet Consectetur, Adipisicing Elit. Ad, Omnis.</p>
                <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
        </div>
    </section> --}}
    <!-- Service section End  -->


    <!-- About section Starts  -->
    <section class="about" id="about">
        <h1 class="heading">
            <span> {{ trans('frontend/home_trans.About_Us') }} </span>
        </h1>
        <div class="row">
            <div class="image">
                <img src="{{ asset('frontend/home/image/about-img.svg') }}" alt="">
            </div>
            <div class="content">
                <h3 style="font-size: 35px;">{{ trans('frontend/home_trans.we take care of your healthy life') }}</h3>
                <p>{{ trans('frontend/home_trans.about_clinic') }}</p>
            </div>
        </div>
    </section>
    <!-- About section End  -->


    <!-- Doctors section Starts  -->
    {{-- <section class="doctors" id="doctors">
        <h1 class="heading">our <span>doctors</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="{{ asset('frontend/home/image/doc-1.jpg') }}" alt="">
                <h3>Dr. john deo</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/doc-2.jpg') }}" alt="">
                <h3>Dr. Pullen</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/doc-3.jpg') }}" alt="">
                <h3> Dr. Swallow</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/doc-4.jpg') }}" alt="">
                <h3>Dr. Mangle</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/doc-5.jpg') }}" alt="">
                <h3>Dr. Fillmore</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/doc-6.jpg') }}" alt="">
                <h3>Dr. Watamaniuk</h3>
                <span>expert doctor</span>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Doctors section Ends  -->


    <!-- Book section Starts  -->
    {{-- <section class="book" id="book">
        <h1 class="heading"><span>book</span> now</h1>
        <div class="row">
            <div class="image">
                <img src="{{ asset('frontend/home/image/book-img.svg') }}" alt="">
            </div>
            <form action="">
                <h3>book appointment</h3>
                <input type="text" placeholder="your name" class="box">
                <input type="number" placeholder="your number" class="box">
                <input type="email" placeholder="your email" class="box">
                <input type="date" class="box">
                <input type="submit" value="book now" class="btn">
            </form>
        </div>
    </section> --}}
    <!-- Book section End  -->

    <!-- Review section Starts  -->
    {{-- <section class="review" id="review">
        <h1 class="heading">client's <span>review</span></h1>
        <div class="box-container">
            <div class="box">
                <img src="{{ asset('frontend/home/image/pic-1.png') }}" alt="">
                <h3>Jazmin Archer</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laboriosam Sapiente Nihil
                    Aperiam? Repellat Sequi Nisi Aliquid Perspiciatis Libero Nobis Rem Numquam Nesciunt Alias Sapiente
                    Minus Voluptatem, Reiciendis Consequuntur Optio Dolorem!</p>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/pic-2.png') }}" alt="">
                <h3>Jazmin Archer</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laboriosam Sapiente Nihil
                    Aperiam? Repellat Sequi Nisi Aliquid Perspiciatis Libero Nobis Rem Numquam Nesciunt Alias Sapiente
                    Minus Voluptatem, Reiciendis Consequuntur Optio Dolorem!</p>
            </div>
            <div class="box">
                <img src="{{ asset('frontend/home/image/pic-3.png') }}" alt="">
                <h3>Abdiel Galloway</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit. Laboriosam Sapiente Nihil
                    Aperiam? Repellat Sequi Nisi Aliquid Perspiciatis Libero Nobis Rem Numquam Nesciunt Alias Sapiente
                    Minus Voluptatem, Reiciendis Consequuntur Optio Dolorem!</p>
            </div>
        </div>
    </section> --}}
    <!-- Review section End  -->

    <!-- Blogs section Starts -->
    {{-- <section class="blogs" id="blogs">
        <h1 class="heading">our <span>blogs</span></h1>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="{{ asset('frontend/home/image/blog-1.jpg') }}" alt="">
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"><i class="fas fa-calendar"></i>1st may, 2021</a>
                        <a href="#"><i class="fas fa-user"></i> by admin</a>
                    </div>
                    <h3>blog title goes here</h3>
                    <p>Lorem Ipsum, Dolor Sit Amet Consectetur Adipisicing Elit. Provident, Eius</p>
                    <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="{{ asset('frontend/home/image/blog-2.jpg') }}" alt="">
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"><i class="fas fa-calendar"></i> 1st may, 2021</a>
                        <a href="#"><i class="fas fa-user"></i> by admin</a>
                    </div>
                    <h3>blog title goes here</h3>
                    <p>Lorem Ipsum, Dolor Sit Amet Consectetur Adipisicing Elit. Provident, Eius</p>
                    <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
                </div>
            </div>
            <div class="box">
                <div class="image">
                    <img src="{{ asset('frontend/home/image/blog-3.jpg') }}" alt="">
                </div>
                <div class="content">
                    <div class="icon">
                        <a href="#"><i class="fas fa-calendar"></i> 1st may, 2021</a>
                        <a href="#"><i class="fas fa-user"></i> by admin</a>
                    </div>
                    <h3>blog title goes here</h3>
                    <p>Lorem Ipsum, Dolor Sit Amet Consectetur Adipisicing Elit. Provident, Eius</p>
                    <a href="#" class="btn">learn more <span class="fas fa-chevron-right"></span> </a>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Blogs section End -->

    <section class="blogs" id="blogs">
        <h1 class="heading"> {{ trans('frontend/home_trans.Our_Blogs') }} </h1>
        <div id="animation-container"
            style="margin:0; padding:0; width:100%; height:50vh; display:flex; justify-content:center; align-items:center; font-size:50pt; font-family: 'Slabo 27px', serif;">
            <span id="animated-text"
                style="font-size:50pt; text-transform:none; font-family: 'Slabo 27px', serif; opacity: 0; text-align:center">
                {{ trans('frontend/home_trans.Coming_Soon') }}
            </span>
        </div>
    </section>


    <!-- Footer section Starts  -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>{{ trans('frontend/home_trans.Quick_Links') }}</h3>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home_trans.Home') }}</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home_trans.About Us') }}</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home_trans.Blogs') }}</a>
            </div>
            <div class="box">
                <h3>{{ trans('frontend/home_trans.Our_Services') }}</h3>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home_trans.Analysis') }}</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> {{ trans('frontend/home_trans.Rays') }}</a>
                {{-- <a href="#"> <i class="fas fa-chevron-left"></i> cardioloty</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> diagnosis</a>
                <a href="#"> <i class="fas fa-chevron-left"></i> ambulance service</a> --}}
            </div>
            <div class="box">
                <h3>{{ trans('frontend/home_trans.Contact_Info') }}</h3>
                <a href="#"> <i class="fas fa-phone"></i> 01111111111</a>
                <a href="#"> <i class="fas fa-envelope"></i> clinic.@gmail.com</a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> Egypt</a>
            </div>
            <div class="box">
                <h3>{{ trans('frontend/home_trans.Follow_Us') }}</h3>

                <a href="#"> <i class="fab fa-facebook-f"></i> facebook</a>
                <a href="#"> <i class="fab fa-twitter"></i> twitter</a>
                <a href="#"> <i class="fab fa-linkedin"></i> linkedin</a>
                <a href="#"> <i class="fab fa-instagram"></i> instagram</a>
                {{-- <a href="#"> <i class="fab fa-youtube"></i> youtube</a> --}}
                {{-- <a href="#"> <i class="fab fa-pinterest"></i> pinterest</a> --}}
            </div>
        </div>
    </section>
    <!-- Footer section End  -->











    <!-- custom js file link  -->
    <script src="{{ asset('frontend/home/js/script.js') }}"></script>
</body>

</html>
