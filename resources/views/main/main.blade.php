<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>
    Giftos
  </title>



  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

  <!-- notif -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- bootstrap core css -->
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">


  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- responsive style -->
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">



  <style>
    .box {
      min-height: 95%;
    }

    .checkbox-wrapper input[type="checkbox"] {
      width: 16px;

      height: 16px;

    }

    input.form-control {
      border-radius: 0;
    }

    input.form-control::placeholder {
      color: #6c757d;
      opacity: 1;
    }

    input.form-control:focus {
      color: #000;
    }

    #toast-container {
      position: fixed;
      top: 2vh;
      left: 59%;
      transform: translate(-50%, 0);
      z-index: 4090;
      */
    }

    .sortable-header {
      text-align: left;
      vertical-align: middle;
    }

    .sortable-header a {
      display: inline-flex;
      align-items: center;
    }

    .sortable-header .sort-arrow {
      margin-left: 5px;
    }

    .sortable-link {
      color: black;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .sortable-link:hover {
      color: blue;
      text-decoration: underline;
    }


    /* .toast-success {
    color: white;
    background-color: rgba(81, 163, 81, 1);
} */
    #toast-container>.toast-success {
      background-color: rgba(81, 163, 81, 0.93);
      color: white;
      opacity: 1;
    }


    #toast-container>.toast-error {
      background-color: #BD362F;
    }
  </style>

</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container " style="z-index: 4080">
        <a class="navbar-brand" href="{{url('/homePage')}}">
          <span>
            Giftos
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item {{ Request::is('homePage') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/homePage') }}">Home</a>
            </li>
            <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
            </li>
            @if (Auth::check())
            <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
              <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
            </li>
            @endif
            <!-- <li class="nav-item">
              <a class="nav-link" href="testimonial.html">
                Testimonial
              </a>
            </li> -->
            @if (Auth::check())

        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" id="logoutForm">
          @csrf
          <button type="submit" class="nav-link btn btn-link" style="cursor: pointer;">Logout</button>
          </form>
        </li>

        <li id="cartNavItem" class="nav-item {{ Request::is('cart') || Request::is('history') ? 'active' : ''}}">
          <a class="nav-link" href="{{ url('/cart')}}">
          <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          </a>
        </li>


      @else

        <li class="nav-item" id="registerNavItem">
          <a class="nav-link" href="{{ url('/register') }}">Register</a>
        </li>

        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/login') }}">
          <i class="fa fa-user" aria-hidden="true"></i>
          <span>
            Login
          </span>
          </a>
        </li>


        </ul>
        <!-- <div class="user_option" id="loginNavItem">
      <a href="{{url("/login")}}">
      <i class="fa fa-user" aria-hidden="true"></i>
      <span>
      Login
      </span>
      </a>
      </div> -->
    @endif
          <form class="d-flex mx-5 my-1" role="search" id="searchForm" method="GET" action="{{ route('search') }}">
            @csrf
            <input class="form-control me-2" placeholder="Search" aria-label="Search" id="searchInput" name="query">
            <button class="btn btn-outline-success" id="search-btn">Search</button>
          </form>
        </div>
  </div>
  </nav>
  </header>

  @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="card">
    <!-- Content for Admin Panel -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
      <a class="navbar-brand" href="#">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse navbar-light bg-light" id="navbarAdmin">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-center w-100 gap-4">
        <li class="nav-item ">
          <a class="btn btn-outline-primary {{ Request::is('ausers') ? 'active' : '' }}" aria-current="page"
          href="{{ url('/ausers') }}">User</a>
        </li>

        <li class="nav-item ">
          <a class="btn btn-outline-primary {{ Request::is('atransaction') ? 'active' : '' }}"
          href="{{ url('/atransaction') }}">Transaction</a>
        </li>
        <li class="nav-item ">
          <a class="btn btn-outline-primary {{ Request::is('aitems') ? 'active' : '' }}"
          href="{{ url('/aitems') }}">Items</a>
        </li>
        </ul>
      </div>
      </div>
    </nav>

    </div>
  @elseif(Auth::check() && Auth::user()->role === 'user')
    <div class="card">
    <!-- Content for Admin Panel -->


    </div>
  @endif


  @yield('content')
  <!-- end header section -->
  <!-- slider section -->
  <!-- info section -->

  <section class="info_section  layout_padding2-top">
    <div class="social_container">
      <div class="social_box">
        <a href="">
          <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
        <a href="">
          <i class="fa fa-youtube" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <div class="info_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <h6>
              ABOUT US
            </h6>
            <p>
                Welcome to Giftos, your trusted online shopping destination. At Giftos, we believe that customer satisfaction is the cornerstone of our success. Our mission is to provide a seamless shopping experience tailored to your needs, offering a vast range of products that combine quality and value.
                <br>
                We’re dedicated to evolving and improving continuously to ensure we meet the ever-changing demands of our customers. Whether it’s through expanding our product selection, enhancing our platform, or offering exceptional support, we aim to exceed your expectations at every turn.
            </p>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_form ">
              <h5>
                Newsletter
              </h5>
              <form action="#">
                <input type="email" placeholder="Enter your email">
                <button>
                  Subscribe
                </button>
              </form>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              NEED HELP
            </h6>
            <p>Need Help? At Giftos, we’re here to make your shopping experience smooth and enjoyable. Whether you have a question, need assistance, or are facing an issue, we’ve got you covered! Below are some quick resources to help you:</p>
            <p>
                have questions? Fill out our Help Request Form, and our team will get back to you ASAP.</p>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>
              CONTACT US
            </h6>
            <div class="info_link-box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span> Gb road 123 london Uk </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>+01 12345678901</span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span> demo@gmail.com</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
      <div class="container">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a>
        </p>
      </div>
    </footer>
    <!-- footer section -->

  </section>

  <!-- end info section -->





  <!--
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script> -->

  <!-- <script>
    var uid = 0;
    $(document).ready(function () {


      function checkLoginStatus() {
        getCookie('userId', function (userId) {
          console.log("Cookie: " + userId);
          if (userId && userId !== 'undefined') {

            $('#registerNavItem').hide();
            $('#loginNavItem').hide();
            $('#cartNavItem').show();
            $('#logoutNavItem').show();
            $('#profileNavItem').show();
          } else {
            $('#registerNavItem').show();
            $('#loginNavItem').show();
            $('#cartNavItem').hide();
            $('#logoutNavItem').hide();
            $('#profileNavItem').hide();

          }
          if (callback) {
            callback(userId);
          }
        });
        checkSession();
      }

      function checkSession() {
        console.log('chk')
        $.ajax({
          type: 'GET',
          url: '/checkSession',
          success: function (response) {
            if (response > 0) {
              $('#registerNavItem').hide();
              $('#loginNavItem').hide();
              $('#cartNavItem').show();
              $('#logoutNavItem').show();
              $('#profileNavItem').show();
              uid = response;
            }
            else {
              $('#registerNavItem').show();
              $('#loginNavItem').show();
              $('#cartNavItem').hide();
              $('#logoutNavItem').hide();
              $('#profileNavItem').hide();
            }
          }
        });
      }

      function getCookie(name, callback) {
        $.ajax({
          url: '/get-cookie',
          method: 'GET',
          success: function (response) {
            if (response == null || response === undefined) {
              console.log(`Cookie ${name} not found`);
              callback(null);
            } else {
              callback(response);
            }
          },
          error: function (xhr, status, error) {
            console.error(`Error retrieving cookie ${name}:`, error);
            callback(null);
          }
        });
      }


      // Logout function
      function logout() {
        $.ajax({
          url: '/logout',
          method: 'GET',
          success: function (response) {
            location.reload();
          },
          error: function () {
            console.error('An error occurred during logout.');
          }
        });
      }


      $('#logoutButton').on('click', function (e) {
        e.preventDefault();
        logout();
      });

      // Check login status
      checkLoginStatus();

      function formatPrice(price) {
        return new Intl.NumberFormat('en-ID', { style: 'currency', currency: 'IDR' }).format(price);
      }

      function generateProductsHTML(item) {
        return `
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <a href="detail.html?product_id=${item.id}">
                        <div class="img-box">
                            <img src="${item.image}" alt="${item.altText}">
                        </div>
                        <div class="detail-box">
                            <h6>${item.name}</h6>
                            <h6>
                                Price <span>${formatPrice(item.price)}</span>
                            </h6>
                            <div class="new">
                          <span>
                            New
                          </span>
                        </div>
                        </div>
                        ${item.new ? '<div class="new"><span>New</span></div>' : ''}
                    </a>
                </div>
            </div>
        `;
      }

      // Function to fetch items using AJAX and inject them into the container
      function fetchAndInjectProducts() {
        $.ajax({
          url: '/search?query=item',
          method: 'GET',
          // query:'item',
          success: function (response) {
            var count = 0;
            response.forEach(function (item) {
              if (count < 4) {


                var newItemHTML = generateProductsHTML(item);
                $('#productbox').append(newItemHTML);

                count++;
              }
            });
          },
          error: function (xhr, status, error) {
            console.error(error);
          }
        });
      }

      //fetchAndInjectItems
      fetchAndInjectProducts();

      function generateItemHTML(item) {
        return `
            <div class="carousel-item">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="detail-box">
                                <h1>${item.name}</h1>
                                <p>${item.description}</p>
                                <a href="shop.html">SHOP NOW!</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="img-box">
                                <img src="${item.image}" alt="${item.altText}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
      }

      // Function to fetch items into the carousel
      function fetchAndInjectItems() {

        $.ajax({
          url: '/carousel-data',
          method: 'GET',
          success: function (response) {
            response.forEach(function (item, index) {

              var newItemHTML = generateItemHTML(item);
              $('#first').append(newItemHTML);
              console.log(index);

            });
          },
          error: function (xhr, status, error) {
            console.error(error);
          }
        });
      }

      // Call the fetchAndInjectItems function to load items when the document is ready
      fetchAndInjectItems();






      $('#searchForm').on('submit', function (event) {
        event.preventDefault();

        var query = $('#searchInput').val();

        searchAndLoad(query);
      });


      function searchAndLoad(query) {

        if (query.startsWith('daftar_')) {
          console.log(query)
          if (uid != 1) {
            console.log(checkSession());
            return;
          }
          window.location.href = 'daftar.html'
        }
        else {
          window.location.href = 'shop.html?search=' + encodeURIComponent(query);
        }
      }


      $("#search-btn").click(function () {
        var query = $("#searchInput").val();
        if (query.trim() !== "") {
          searchAndLoad(query);
        }
      });


      $("#searchInput").keypress(function (event) {
        if (event.which === 13) { // Enter key pressed
          var query = $("#searchInput").val();
          if (query.trim() !== "") {
            searchAndLoad(query);
          }
        }
      });
    });

    function checkSession() {
      console.log('chk')
      $.ajax({
        type: 'GET',
        url: '/checkSession',
        success: function (response) {
          if (response > 0) {
            // User is logged in
            // console.log('in')
            $('#registerNavItem').hide();
            $('#loginNavItem').hide();
            $('#cartNavItem').show();
            $('#logoutNavItem').show();
            $('#profileNavItem').show();
            console.log("uid:" + response);
            uid = response;

            console.log("reel uid" + uid);
          } else {
            // console.log(response)
            // User is not logged in, show Register and Login, hide Logout
            $('#registerNavItem').show();
            $('#loginNavItem').show();
            $('#cartNavItem').hide();
            $('#logoutNavItem').hide();
            $('#profileNavItem').hide();
          }
        }
      });

    }





  </script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
