<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <router-link class="navbar-brand" to="/">GESTION ACADEMICA</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <router-link class="nav-link text-white" to='/'>Inicio</router-link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Estudiantes
            </a>
            <ul class="dropdown-menu text-center">
              <li>
                <router-link class="dropdown-item" to='/'>Listar Estudiantes</router-link>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <router-link class="dropdown-item" to='/addEstudiante'>Registrar Nuevo</router-link>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <router-view />
  </div>
</template>