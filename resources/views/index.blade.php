@extends('dashboard')
@section('i')
    <div class="carousel">
        <div class="carousel__contenedor">
            <button aria-label="Anterior" class="carousel__anterior">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="carousel__lista">
                <div class="carousel__elemento">
                    <img src="https://m.media-amazon.com/images/I/71py6K2968L._AC_SX466_.jpg"
                        alt="Rock and Roll Hall of Fame">
                    <p>Rock and Roll Hall of Fame</p>
                </div>
                <div class="carousel__elemento">
                    <img src="img/3.png" alt="Constitution Square - Tower I">
                    <p>Constitution Square - Tower I</p>
                </div>
                <div class="carousel__elemento">
                    <img src="img/4.png" alt="Empire State Building">
                    <p>Empire State Building</p>
                </div>
                <div class="carousel__elemento">
                    <img src="img/5.png" alt="Harmony Tower">
                    <p>Harmony Tower</p>
                </div>

                <div class="carousel__elemento">
                    <img src="img/6.png" alt="Empire State Building">
                    <p>Empire State Building</p>
                </div>
                <div class="carousel__elemento">
                    <img src="img/7.png" alt="Harmony Tower">
                    <p>Harmony Tower</p>
                </div>
                <div class="carousel__elemento">
                    <img src="img/8.png" alt="Empire State Building">
                    <p>Empire State Building</p>
                </div>
                <div class="carousel__elemento">
                    <img src="img/9.png" alt="Harmony Tower">
                    <p>Harmony Tower</p>
                </div>
            </div>

            <button aria-label="Siguiente" class="carousel__siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div role="tablist" class="carousel__indicadores"></div>
    </div>
    </div>

    <script src="{{ asset('static/glider/glider.min.js') }}"></script>
    <script>
        window.addEventListener('load', function() {
            new Glider(document.querySelector('.carousel__lista'), {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: '.carousel__indicadores',
                arrows: {
                    prev: '.carousel__anterior',
                    next: '.carousel__siguiente'
                },
                responsive: [{
                    // screens greater than >= 775px
                    breakpoint: 450,
                    settings: {
                        // Set to `auto` and provide item width to adjust to viewport
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                }, {
                    // screens greater than >= 1024px
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                }]
            });
        });
    </script>

@endsection
