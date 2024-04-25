import Swal from 'sweetalert2';
import axios from 'axios';

export function mostrarAlerta(titulo, icono, foco=''){
  if(foco != ''){
    document.getElementById(foco).focus();
  }

  Swal.fire({
    title: titulo,
    icon: icono,
    customClass:{confirmButton: 'btn btn-primary', popup: 'animated zoonIn'},
    buttonsStyling: false
  });
}

export function confirmar(url, id, titulo, mensaje){
  var ruta = url + id;
  const SwalWithBootstrapButton = Swal.mixin({
    customClass:{confirmButton: 'btn btn-success me-3', cancelButton: 'btn btn-danger '}
  });

  SwalWithBootstrapButton.fire({
    title: titulo,
    text: mensaje,
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '<li class="fa-solid fa-check"></li> Si, Eliminar',
    cancelButtonText: '<li class="fa-solid fa-ban"></li> Cancelar'
  }).then((res)=>{
    if(res.isConfirmed){
      enviarSolicitud('DELETE', {id: id}, ruta, 'Eliminado con exito');
    }else{
      mostrarAlerta('Solicitud Cancelada', 'info');
    }
  });

  /* Swal.fire({
    title: titulo,
    icon: icono,
    customClass:{confirmButton: 'btn btn-primary', popup: 'animated zoonIn'},
    buttonsStyling: false
  }); */
}

export function enviarSolicitud(metodo, parametros, url, mensaje){
  axios({method: metodo, url: url, data: parametros}).then(function(res){
    var estado = res.status;
    if(estado == 200){
      mostrarAlerta(mensaje, 'success');
      window.setTimeout(function(){
        window.location.href = '/'
      }, 3000);
    }else{
      mostrarAlerta('Algo salio mal, intente más trade', 'error');
    }
  }).catch(function(error){
    mostrarAlerta('Servidor no disponible', 'error');
  });
}
