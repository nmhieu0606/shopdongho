<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('asset/site') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('asset/site') }}/css/tiny-slider.css" rel="stylesheet">
    <link href="{{ asset('asset/site') }}/css/style.css" rel="stylesheet">
    <title>shopwatch</title>
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="{{route('home.index')}}">shopwatch<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home.index')}}">Home</a>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Danh mục sản phẩm
                        </a>
                        <ul class="dropdown-menu bg-success bg-gradient ">
                            @foreach ($danhmuc as $item)
                                <li><a class="dropdown-item text-primary" href="{{route('home.danhmuc',$item->id)}}">{{ $item->tendanhmuc }}</a>
                                </li>
                            @endforeach


                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Nhãn hiệu
                        </a>
                        <ul class="dropdown-menu bg-success bg-gradient ">
                            @foreach ($nhanhieu as $item)
                                <li><a class="dropdown-item text-primary" href="{{route('home.nhanhieu',$item->id)}}">{{ $item->nhanhieu }}</a>
                                </li>
                            @endforeach


                        </ul>
                    </li>

                    <li>

                        <div class="dropdown">
                            <input id="search" class="btn btn-primary bg-white text-dark dropdown-toggle" type="search" id="dropdownMenuButton"
                                data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false">
                                
						</>
                            <ul id="dropdown" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                               
                               
                            </ul>
                        </div>
                    </li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    @if (Auth::user())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <span>{{ Auth::user()->hovaten }}</span>
                            </a>
                            <ul class="dropdown-menu bg-success bg-gradient ">
                                <li><a class="dropdown-item text-white" href="{{route('home.history')}}">Lịch sử mua hàng</a></li>
                                <li><a class="dropdown-item text-white" href="{{ route('home.logout') }}">Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a class="nav-link" href="{{ route('home.getLogin') }}"><img
                                    src="{{ asset('asset/site') }}/images/user.svg"></a></li>
                    @endif



                    <li><a class="nav-link" href="{{ route('home.getCart') }}"><img
                                src="{{ asset('asset/site') }}/images/cart.svg"></a></li>
                </ul>
            </div>
        </div>

    </nav>


    @if (Session::has('yes'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('yes') }}</p>
    @endif
    @if (Session::has('no'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('no') }}</p>
    @endif

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">


                @yield('main')



            </div>
        </div>
    </div>
    <!-- End Product Section -->





    <!-- Start Footer Section -->
    <footer class="footer-section">
        <div class="container relative">


            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                           
                        </p>
                    </div>

                  
                </div>
            </div>

        </div>
    </footer>
    <!-- End Footer Section -->


    <script src="{{ asset('asset/site') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/site') }}/js/tiny-slider.js"></script>
    <script src="{{ asset('asset/site') }}/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $('#search').change(function(e) {
            e.preventDefault();
            var url = 'http://localhost/shopdongho/search';
            var val = $(this).val();
			
            
            $.ajax({
                type: "GET",
                url:url+'?tukhoa='+val,
                success: function(res) {
                      for (var sp of  res) {
                            
                            let url=sp.id;
                            console.log(sp);
                            var _html='';
                            _html+='<li><img class="anh-search mt-3 w-25" src="{{url('public/uploads')}}/'+sp.anh+'"><a class="dropdown-item nav-link nav_item" href="http://localhost/shopdongho/search/'+url+'">'+sp.tensp+'</li>';
                        }
                        $('#dropdown').html(_html);

                        $('#dropdown').show();

                }
            });

        });
    </script>
</body>

</html>
