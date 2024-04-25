<template>
  <div class="row mt-5">
    <div class="col-lg-8 offset-lg-2">
      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>APELLIDOS</th>
              <th>FOTO</th>
              <th>REGISTRO</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="contenido">
          <tr v-if="this.cargando">
            <td colspan="6"><h3>Cargando...</h3></td>
          </tr>
          <tr v-else v-for="est, i in this.estudiantes" :key="est.id">
            <td v-text="est.id"></td>
            <td v-text="est.nombre"></td>
            <td v-text="est.apellidos"></td>
            <td>
              <img v-if="est.foto" style="width: 100px !important;" :src="est.foto" class="img-thumbnail" alt="" />
              <img v-else style="width: 100px; height: 100px;" src="https://cdn1.iconfinder.com/data/icons/user-pictures/101/malecostume-256.png" class="img-thumbnail" alt="" />
            </td>
            <td v-text="new Date(est.created_at).toLocaleDateString()"></td>
            <td>
              <router-link :to="{path:'detailEstudiante/'+est.id}" class="btn btn-info"><li class="fa-solid fa-eye"></li></router-link>
              &nbsp;
              <router-link :to="{path:'updateEstudiante/'+est.id}" class="btn btn-warning"><li class="fa-solid fa-pencil"></li></router-link>
              &nbsp;
              <button v-on:click="deleteEstudiante(est.id, est.nombre, est.apellidos)"  class="btn btn-danger"><li class="fa-solid fa-trash"></li></button>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import { confirmar } from '../funciones.js';

  export default{
    data(){
      return {
        estudiantes: null,
        cargando: false
      }
    },
    mounted(){
      this.getEstudiantes();
    },
    methods:{
      getEstudiantes(){
        this.cargando = true;
        axios.get(`${process.env.VUE_APP_URL_BACKEND}/api/v1/estudiantes`).then(
          res => {
            this.estudiantes = res.data;
            this.cargando = false;
          }
        );
      },
      deleteEstudiante(id, nombre, apellidos){
        confirmar(`${process.env.VUE_APP_URL_BACKEND}/api/v1/estudiantes/`, id, 'Eliminar Estudiante', '¿Realmente desea eliminar a ' + nombre + ' ' + apellidos + '?');
        this.cargando = false;
      }
    }
  }
</script>
