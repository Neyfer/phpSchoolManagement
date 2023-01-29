<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Dashboard Template · Bootstrap .2</title>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../dashboard.css" rel="stylesheet">
  </head>
  <body>

<div class="container-fluid">
  <div class="row" >
    <nav id="" class="col-md-3 col-lg-2 d-md-block bg-light  collapse navbar-collapse sidebar" id="sidebarMenu">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <h6 class="px-3 sidebar-heading mt-1 mb-1 text-muted text-uppercase">Datos</h6>
          <li class="nav-item">
            <a class="nav-link dash" aria-current="page" href="#">
              <img src="../icons/home.svg" style="vertical-align: baseline" width="15" height="15">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="teachers-dash" href="./teachers.php">
              <img src="../icons/teacher.svg" style="vertical-align: baseline" width="15" height="15">
              Maestros
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="parents-dash" href="./parents.php">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              <img src="../icons/parents.svg" style="vertical-align: baseline" width="15" height="15">
              Padres
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="students-dash" href="./students.php">
              <span data-feather="users" class="align-text-bottom"></span>
              <img src="../icons/student.svg" style="vertical-align: baseline" width="15" height="15">
              Alumnos
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Funciones</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" id='matricula-dash' href="./matricula.php">
              <img src="../icons/new_student.svg" style="vertical-align: baseline" width="15" height="15">
             Matricula
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="notas-dash" href="ingresar_notas.php">
              <img src="../icons/ingresar_notats.svg" style="vertical-align: baseline" width="15" height="15">
              Ingresar Notas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id='materias-dash' href="Materias.php?id=7">
              <img src="../icons/ingresar_notats.svg" style="vertical-align: baseline" width="15" height="15">
              Asignaturas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="calificaciones-dash" href="generar_calificaciones.php">
              <span data-feather="file-text" class="align-text-bottom"></span>
              <img src="../icons/generar_boletas.svg" style="vertical-align: baseline" width="15" height="15">
               boletas de calificacion
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              <img src="../icons/certificacion_estudios.svg
               " style="vertical-align: baseline" width="15" height="15">
               Certificacion de Estudios
            </a>
          </li>
        </ul>

        <h6 class="px-3 sidebar-heading mt-1 mb-1 text-muted text-uppercase">Pagina web</h6>
      </div>
    </nav>
  </div>
</div>

    </body>
</html>
