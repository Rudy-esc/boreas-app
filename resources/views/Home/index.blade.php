<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--Boxincons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>

<nav class="sidebar close">
<header>
  <div class="image-text">
      <span class="image">
        <img src="{{ asset('img/logo.png    ') }}" alt="logo">
      </span>

      <div class="text header-text">
        <span class="name">ITAT</span>
        <span class="reserva">Modulo de Reservas</span>
      </div>
  </div>
  <i class='bx bx-chevron-right toggle'></i>
</header>

<div class="menu-bar">
    <div class="menu">
        <ul class="menu-links">
            <li class="nav-links">
                <a href="{{route('Home.index')}}">
                    <i class='bx bx-home-alt icon' ></i>
                    <span class="text nav-text">Inicio</span>
                </a>
            </li>
            <li class="nav-links">
                <a href="{{ route('solicitud.index') }}">
                    <i class='bx bx-calendar icon' ></i>
                    <span class="text nav-text">Reserva</span>
                </a>
            </li>
            <li class="nav-links">
                <a href="{{ route('sitios.index') }}">
                    <i class='bx bx-current-location icon' ></i>
                    <span class="text nav-text">Sitios</span>
                </a>
            </li>
            <li class="nav-links">
                <a href="{{ route('objeto.index') }}">
                    <i class='bx bxs-package icon' ></i>
                    <span class="text nav-text">Objetos</span>
                </a>
            </li>
        </ul>
    </div>
    
</div>

</nav>



<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>


</body>
</html>