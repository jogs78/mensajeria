<section class="dashboard-informatico">
    <div class="carousel">
        <div class="carousel__contenedor">
            <i class="fas fa-arrow-circle-left carousel__anterior"></i>
            <div class="carousel__lista">
                @php
                    $i = 0;
                @endphp

                @if ($c_carreras != null)
                    @foreach ($c_carreras as $carrera)
                        <div class="carousel__elemento">
                            <form class="deleteCareer" style="position: relative;z-index: 1000;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{ $carrera->id }}" class="carreraId">
                                <button type="submit" class="fas fa-minus-circle delete-career"></button>
                            </form>
                            <label>{{ $carrera->name }}</label>
                            <img class="img-logoCarrera" src="{{ $carrera->logo }}">
                            @if ($c_total != null)
                                <label>Alumnos Registrados: {{ $c_total[$i] }}</label>
                            @endif
                            @php $i++;@endphp
                        </div>
                    @endforeach
                @endif
                <div style="display: flex" title="Añadir carrera" id="lastChild">
                    <label class="fas fa-plus-circle add-career" id="addCareer"></label>
                </div>

            </div>
            <i class="fas fa-arrow-circle-right carousel__siguiente"></i>
            <div role="tablist" class="carousel__indicadores"></div>
        </div>
    </div>
    <div class="dashboard-informatico__container">

    </div>
    <div class="alumnos-carreras__container">
        <div class="total-usuarios">
            @php
                $total = $c_alumnos + $c_empleados;
            @endphp
            <label class="total-usuarios__lbl_total">Usuarios registrados: {{ $total }}</label>
            <div class="total-usuarios__container">
                <div>
                    <img class="total-usuarios__img"
                        src="https://icons-for-free.com/iconfiles/png/512/student-131964785014431620.png" alt="">
                    <label class="total-usuarios__lbl">Alumnos: {{ $c_alumnos }}</label>
                </div>
                <div>

                    <img class="total-usuarios__img"
                        src="https://usefulicons.com/uploads/icons/202105/3714/84d810328ade.png" alt="">
                    <label class="total-usuarios__lbl">Empleados: {{ $c_empleados }}</label>
                </div>
            </div>

            <a href="/user" class="btn__verUsuarios"> Ver usuarios</a>
        </div>
    </div>
</section>
<section class="addCareer">
    <div class="addCareer-container" id="addCareer-container">
        <form class="form-addCareer" id="form-addCareer" method="POST" enctype="multipart/form-data">
            @csrf
            <i class="fas fa-times-circle closeWindow" id="close"></i>
            <h2>Agregar Carrera</h2>
            <input type="text" name="carrera" id="addcarrera" class="form-addCareer__input">
            <label for="">Logo</label>
            <input type="file" name="logo" id="logo" class="form-addCareer__input" accept="image/*">
            <label for=""></label>
            <button type="submit" class="btn__verUsuarios">Agregar</button>
        </form>
    </div>
</section>

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
