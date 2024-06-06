<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zoo website</title>
    <link rel="shortcut icon" href="{{ asset('assets_login/images/favicon.png') }}">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link href="{{ asset('assets_zoo/css/style.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <!-- header -->

    <header class="header">

        <a href="#" class="logo"> <i class="fas fa-paw"></i> zoo</a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#gallery">gallery</a>
            <a href="#animal">animal</a>
            <a href="#pricing">pricing</a>
            <a href="#contact">contact</a>
        </nav>

        <div class="icons">
            <div id="login-btn">
                @if (Route::has('login'))
                            @auth
                            @php
                                $route_get = App\Models\User::GetFirstRoute()->first();
                            @endphp
                            <a href="{{ route($route_get->route) }}" class="btn text-center btn-custom btn-icon-muted btn-active-info btn-active-color-info text-white">{{ $route_get->name}}</a>
                            @else
                            <a href="{{ route('login') }}" class="btn text-center btn-custom btn-icon-muted btn-active-info btn-active-color-info text-white">Login</a>
                            {{-- <a href="{{ route('register') }}" class="btn text-center btn-custom btn-icon-muted btn-active-info btn-active-color-info custom-button text-white fs-5">Register</a> --}}
                            @endauth
                            @endif
            </div>
        </div>

        <!-- login form -->

    {{-- <form action="{{ route('login') }}" class="login-form">
        @csrf
        <h3>login form</h3>

        <label for="email" class="form-label text-dark">Email</label>
        <input type="email" class="box" id="email"
            placeholder="Enter email address" name="email" value="{{ old('email') }}"
            required placeholder="Email" autocomplete="email" autofocus>
        <x-form.validation.error name="email" />
                                        <div class="password-container">
                                            <input type="password" class="box" placeholder="Enter password"
                                                   id="password-input" name="password" required autocomplete="current-password">
                                            <i class="fas fa-eye toggle-password" id="toggle-password"></i>
                                        </div>
                                        <x-form.validation.error name="password" />
        <div class="remember">
            <input type="checkbox" name="" id="remember-me">
            <label for="remember-me">remember me</label>
        </div>
        <div class="row mb-4 justify-content-center">
            <div class="col">
                <div class="">
                    <button class="btn btn-dark btn-submit w-100 btn-md"
                        type="submit">Masuk</button>
                </div>
            </div>
        </div>

    </form> --}}

    </header>


    <!-- end -->

    <!-- home -->

    <section class="home" id="home">

        <div class="content " style="padding-top : 20px">
            <h3>Menjelajah kekayaan alam <br> selamat datang di <br> Rimba Zoo Adventure</h3>
            <a href="#animal" class="btn">lihat hewan</a>
        </div>

        <img src="{{asset('assets_zoo/images/bottom_wave.png')}}" alt="" class="wave">

    </section>

    <!-- end -->

    <!-- about -->

    <section class="about" id="about">

        <h2 class="deco-title">binatang</h2>

        <div class="box-container">

            <div class="image">
                <img src="{{asset('assets_zoo/images/about.png')}}" alt="">
            </div>

            <div class="content">
                <h3 class="title">anda dapat menemukan spesies paling popular</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Nesciunt temporibus ipsum consectetur asperiores modi ratione.
                    Sit, dolores voluptas consequuntur dolor tempore quibusdam est
                    obcaecati possimus omnis, officiis molestias et sapiente.</p>

                <div class="icons-container">
                    <div class="icons">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>belajar</h3>
                    </div>
                    <div class="icons">
                        <i class="fas fa-bullhorn"></i>
                        <h3>bermain</h3>
                    </div>
                    <div class="icons">
                        <i class="fas fa-book-open"></i>
                        <h3>mengenal hewan</h3>
                    </div>
                </div>
            </div>

        </div>

    </section>


    <!-- end -->

    <!-- end -->

    <!-- animals -->

    <section class="animal" id="animal">

        <h2 class="heading">hewan</h2>

        <div class="box-container">

            <div class="box">
                <img src="{{asset ('assets_zoo/images/animal_1.jpg')}}" alt="">
                <div class="content">
                    <h3>cameleon</h3>
                    <a href="bunglon\bunglon.html" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{ asset('assets_zoo/images/gajah.jpg')}}" alt="">
                <div class="content">
                    <h3>Gajah</h3>
                    <a href="gajah\gajah.html" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset ('assets_zoo/images/animals_2.jpg')}}" alt="">
                <div class="content">
                    <h3>zebra</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset ('assets_zoo/images/animals_3.jpg')}}" alt="">
                <div class="content">
                    <h3>Jerapah</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset ('assets_zoo/images/animals_4.jpg')}}" alt="">
                <div class="content">
                    <h3>monyet</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{ asset('assets_zoo/images/singa.jpg')}}" alt="">
                <div class="content">
                    <h3>Singa</h3>
                    <a href="SINGA.html" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{ asset('assets_zoo/images/harimau.jpg')}}" alt="">
                <div class="content">
                    <h3>Harimau</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{ asset('assets_zoo/images/badak.jpg')}}" alt="">
                <div class="content">
                    <h3>Badak</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{ asset('assets_zoo/images/hyena.jpg')}}" alt="">
                <div class="content">
                    <h3>Hyena</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/burung unta.jpg')}}" alt="">
                <div class="content">
                    <h3>burung unta</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/rusa.jpg')}}" alt="">
                <div class="content">
                    <h3>Rusa</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/byson.jpg')}}" alt="">
                <div class="content">
                    <h3>Byson</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/bekantan.jpg')}}" alt="">
                <div class="content">
                    <h3>Bekantan</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/kuda nil.jpg')}}" alt="">
                <div class="content">
                    <h3>Kuda nil</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/merak.jpg')}}" alt="">
                <div class="content">
                    <h3>Merak</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/buaya.jpg')}}" alt="">
                <div class="content">
                    <h3>Buaya</h3>
                    <a href="#" class="btn">lihat detail</a>
                </div>
            </div>

        </div>

    </section>

    <!-- end -->

    <!-- banner -->

    <section class="banner">

        <div class="row">

            <div class="content">
                <h3>Apa Itu Hewan?</h3>
            <p>Hewan, binatang, atau satwa adalah organisme eukariotik multiseluler yang membentuk kerajaan biologi Animalia.
                Dengan sedikit pengecualian, hewan mengonsumsi bahan organik, menghirup oksigen, dapat bergerak, bereproduksi secara seksual,
                dan tumbuh dari bola sel yang berongga, blastula, selama fase perkembangan embrio. Lebih dari 1,5 juta spesies hewan yang
                masih hidup telah dideskripsikan sekitar 1 juta di antaranya adalah serangga tetapi
                diperkirakan ada lebih dari 7 juta spesies hewan secara keseluruhan.
                Hewan memiliki panjang dari 8,5 mikrometer sampai 33,6 meter dan memiliki interaksi yang kompleks dengan satu sama lain
                dan dengan lingkungannya, serta membentuk jaring-jaring makanan yang rumit. Studi tentang hewan disebut zoologi.</p>
            </div>

            <div class="image">
                <img src="{{asset('assets_zoo/images/banner_1.png')}}" alt="" style="margin-bottom:55px">
            </div>

        </div>

    </section>

    <!-- end -->

    <!-- pricing -->

    <section class="pricing" id="pricing">

        <h2 class="heading">Harga</h2>

        <div class="box-container">

            <div class="box">
                <img src="{{asset('assets_zoo/images/pricing1.png')}}" alt="">
                <h3>perorangan</h3>
                <h4 class="price"> rp 50.000 </h4>
                <p>8:00 - 17:00</p>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/pricing2.png')}}" alt="">
                <h3>sekolah</h3>
                <h4 class="price"> rp 40.000 </h4>
                <p>8:00 - 17:00</p>
            </div>

            <div class="box">
                <img src="{{asset('assets_zoo/images/pricing1.png')}}" alt="">
                <h3>keluarga</h3>
                <h4 class="price"> rp 90.000 </h4>
                <p>8:00 - 17:00</p>
            </div>

        </div>

    </section>


    <!-- end -->

    <!-- contact -->

    <section class="reservation" id="reservation">

        <h2 class="heading">Reservation</h2>

        <form id="reservation-form" action="{{ route('reservation.store') }}" method="POST">
            @csrf
        
            <div class="inputBox">
                <input type="text" name="name" placeholder="Name" id="name" required>
            </div>
            <div class="inputBox">
                <input type="email" name="email" placeholder="Email" id="email" required>
            </div>
            <div class="inputBox">
                <label>Age Group:</label><br>
                <label for="baby-quantity">Baby (0 - 11 months)</label><br>
                <input type="number" name="categories[baby]" id="baby-quantity" min="0" value="0">
        
                <label for="child-quantity">Child (1 - 10 years)</label><br>
                <input type="number" name="categories[child]" id="child-quantity" min="0" value="0">
        
                <label for="teen-quantity">Teen (11 - 19 years)</label><br>
                <input type="number" name="categories[teen]" id="teen-quantity" min="0" value="0">
        
                <label for="adult-quantity">Adult (20+ years)</label>
                <input type="number" name="categories[adult]" id="adult-quantity" min="0" value="0">
            </div>
        
            <div class="inputBox">
                <input type="submit" value="Submit">
            </div>
        </form>

    </section>

    <!-- end -->

    <!-- footer -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3><i class="fas fa-paw"></i> zoo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p class="links"><i class="fas fa-clock"></i>monday - friday</p>
                <p class="days">8:00AM - 15:00PM</p>
            </div>

            <div class="box">
                <h3>Contact Info</h3>
                <a href="#" class="links"><i class="fas fa-phone"></i> 089512966965</a>
                <a href="#" class="links"><i class="fas fa-phone"></i> 081617705793</a>
                <a href="#" class="links"><i class="fas fa-phone"></i> 085255422054</a>
                <a href="#" class="links"><i class="fas fa-envelope"></i> info@zoolife.com</a>
                <a href="#" class="links"><i class="fas fa-map-marker-alt"></i> Bandung, Indonesia</a>
            </div>

            <div class="box">
                <h3>quick links</h3>
                <a href="#" class="links"> <i class="fas fa-arrow-right"></i>home</a>
                <a href="#" class="links"> <i class="fas fa-arrow-right"></i>about</a>
                <a href="#" class="links"> <i class="fas fa-arrow-right"></i>gallery</a>
                <a href="#" class="links"> <i class="fas fa-arrow-right"></i>animal</a>
                <a href="#" class="links"> <i class="fas fa-arrow-right"></i>pricing</a>
            </div>

            <div class="box">
                <h3>newsletter</h3>
                <p>subscribe for latest updates</p>
                <input type="email" placeholder="Your Email" class="email">
                <a href="#" class="btn">subscribe</a>
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
            </div>

        </div>

        <div class="credit">&copy; 2024 zoolife. All rights reserved by <a href="#" class="link">Kelompok 3</a></div>

    </section>


    <!-- end -->

    <script>
        function toggleQuantity(category) {
            var quantityDiv = document.getElementById(category + '-quantity');
            quantityDiv.classList.toggle('hidden');
        }
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('reservation-form').addEventListener('submit', function (e) {
                e.preventDefault(); // Mencegah pengiriman formulir langsung
    
                Swal.fire({
                    title: 'Konfirmasi Pemesanan Tiket',
                    text: 'Apakah Anda yakin ingin melanjutkan pemesanan tiket?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Melanjutkan dengan pengiriman formulir
                    }
                });
            });
        });
    </script>
    
      

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password-input');
            const toggleIcon = this;
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script src="{{ asset('assets_zoo/js/script.js') }}"></script>

</body>
</html>
