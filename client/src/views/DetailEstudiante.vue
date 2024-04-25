<template>
  <div class="row mt-3">
    <div class="col-md-6 offset-md-3">
      <div class="card mb-3">
        <div class="card-header bg-dark text-white text-center">Datos del Estudiante</div>
        <div class="card-body">
          <div class="d-grid col-2 mb-3">
            <router-link class="btn btn-success" :to="{ path: '/' }"><i class="fa-solid fa-arrow-left"></i>
              Volver</router-link>
          </div>
          <div class="d-grid col-6 mx-auto mb-3">
            <img v-if="this.foto" height="100" :src="this.foto" id="fotoimg" class="img-thumbnail" />
            <img v-else height="100" id="fotoimg"
              src="https://cdn1.iconfinder.com/data/icons/user-pictures/101/malecostume-256.png" class="img-thumbnail"
              alt="" />
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <label v-text="nombre" class="form-control"></label>
          </div>
          <div class="input-group mb-1">
            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
            <label v-text="apellidos"  class="form-control"></label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { mostrarAlerta, enviarSolicitud } from '../funciones.js';
import { useRoute } from 'vue-router';
import axios from 'axios';

export default {
  data() {
    return {
      id: 0,
      nombre: '',
      apellidos: '',
      foto: '',
      url: `${process.env.VUE_APP_URL_BACKEND}/api/v1/estudiantes/`
    }
  },
  mounted() {
    const route = useRoute();
    this.id = route.params.id;
    this.url = this.url + this.id;
    this.getEstudiante();
  },
  methods: {
    getEstudiante() {
      axios.get(this.url).then(
        res => {
          this.nombre = res.data.data.nombre;
          this.apellidos = res.data.data.apellidos;
          this.foto = res.data.data.foto;
        }
      );
    },
    updateEstudiante() {
      event.preventDefault();
      var miFoto = document.getElementById('fotoimg');
      this.foto = miFoto.src;

      if (this.nombre.trim() === '') {
        mostrarAlerta('Debe ingresar un nombre', 'warning', 'nombre');
      } else if (this.apellidos.trim() === '') {
        mostrarAlerta('Debe ingresar un apellido', 'warning', 'apellidos');
      } else {
        var parametros = { nombre: this.nombre.trim(), apellidos: this.apellidos.trim(), foto: this.foto.trim() }
        enviarSolicitud('PUT', parametros, this.url, 'Estudiante actualizado exitosamente!');
      }

    },
    previsualizarFoto(e) {
      var reader = new FileReader();
      reader.readAsDataURL(e.target.files[0]);
      reader.onload = function () {
        var miFoto = document.getElementById('fotoimg');
        miFoto.src = reader.result;
        this.foto = miFoto.src;
      }
    }
  }
}
</script>