<template>
  <main class="main">
      <!-- Breadcrumb -->
      <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      <div class="container-fluid">
          <!-- Ejemplo de tabla Listado -->
          <div class="card">
              <div class="card-header">
                  <i class="fa fa-align-justify"></i> Categorías
                  <button type="button" @click="abrirModal('categoria','registrar')" class="btn btn-secondary">
                      <i class="icon-plus"></i>&nbsp;Nuevo
                  </button>
              </div>
              <div class="card-body">
                  <div class="form-group row">
                      <div class="col-md-6">
                          <div class="input-group">
                              <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Nombre</option>
                                <option value="descripcion">Descripción</option>
                              </select>
                              <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                          </div>
                      </div>
                  </div>
                  <table class="table table-bordered table-striped table-sm">
                      <thead>
                          <tr>
                              <th>Opciones</th>
                              <th>Nombre</th>
                              <th>Descripción</th>
                              <th>Estado</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                              <td>
                                  <button type="button" @click="abrirModal('categoria','actualizar',categoria)" class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                  </button> &nbsp;
                                  <button type="button" class="btn btn-danger btn-sm">
                                    <i class="icon-trash"></i>
                                  </button>
                              </td>
                              <td v-text="categoria.nombre"></td>
                              <td v-text="categoria.descripcion"></td>
                              <td>
                                  <div v-if="categoria.condicion">
                                    <span class="badge badge-success">Activo</span>
                                  </div>
                                  <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                  <nav>
                      <ul class="pagination">
                          <li class="page-item">
                              <a class="page-link" href="#">Ant</a>
                          </li>
                          <li class="page-item active">
                              <a class="page-link" href="#">1</a>
                          </li>
                          <li class="page-item">
                              <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                              <a class="page-link" href="#">3</a>
                          </li>
                          <li class="page-item">
                              <a class="page-link" href="#">4</a>
                          </li>
                          <li class="page-item">
                              <a class="page-link" href="#">Sig</a>
                          </li>
                      </ul>
                  </nav>
              </div>
          </div>
          <!-- Fin ejemplo de tabla Listado -->
      </div>
      <!--Inicio del modal agregar/actualizar-->
      <div class="modal fade" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-primary modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" v-text="tituloModal"></h4>
                      <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="nombre" class="form-control" placeholder="Nombre de categoría">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                              <div class="col-md-9">
                                  <input type="email" v-model="descripcion" class="form-control" placeholder="Ingrese descripcion">
                              </div>
                          </div>
                          <div v-show="errorCategoria==1" class="form-group row div-error">
                            <div class="text-center text-error">
                              <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">

                              </div>
                            </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                      <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarCategoria()">Guardar</button>
                      <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarCategoria()">Actualizar</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!--Fin del modal-->
      <!-- Inicio del modal Eliminar -->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-danger" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Eliminar Categoría</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>Estas seguro de eliminar la categoría?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-danger">Eliminar</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- Fin del modal Eliminar -->
  </main>
</template>

<script>
    export default {
      data (){
        return {
          //variables:
          nombre:"",
          descripcion:"",
          categoria_id:0,
          arrayCategoria:[],
          modal:0, //Esta variable indicara si mostrar o ocultar nuestra ventana modal
          tituloModal:'', //Para mostrar el titulo, si es registrar o actualizar categoria
          tipoAccion:0, //Para que el boton diga guardar o actualizar segun la accion que hagamos
          errorCategoria:0, //Indicara si existe algun error en algun campo del formulario 0=No existe , 1=Existe
          errorMostrarMsjCategoria:[] //Un arreglo donde se iran almacenando todos los errores que existiran en un campo
        }
      },
      methods : {
        listarCategoria(){//Obtiene los datos y los asigna al arreglo arrayCategoria
          var me = this;
          axios.get('/categoria').then(function (response) { //El verbo get de axios se utiliza para obtener los datos desde la BD
          // handle success
          me.arrayCategoria = response.data;

        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
      },



        registrarCategoria(){ //Guarda los datos en la BD
        if(this.validarCategoria()==1){ //Si devuelve 1 entonces tengo 1 error y no guardo los datos en la BD
          return
        }else{ //Si no hay errores en los campos entonces se ejecuta las instrucciones para guardar los datos en la BD.
          var me=this;
          axios.post('/categoria/registrar',{'name':this.nombre,'desc':this.descripcion})
          .then(function (response) { //el verbo post sirve para enviar datos, como primer parametro la direccion URL a la cual se enviara los datos, y como segundo los datos que se ingresaran en el formulario en forma de variables, cabe decir que las variables tienen que tener el mismo nombre de las que se recibira en el request de la funcion store del controlador
          // En caso de que se guarden los datos en la base de datos hay que ejecutar los siguientes metodos
          me.cerrarModal();
          me.listarCategoria();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
          } //fin else
        },

        validarCategoria(){
          this.errorCategoria=0;
          this.errorMostrarMsjCategoria=[];
          if(!this.nombre){ //Si el nombre esta vacio, entonces...
            this.errorMostrarMsjCategoria.push("EL nombre de la categoria no puede estar vacio.");
            if(this.errorMostrarMsjCategoria.length){
              this.errorCategoria=1;
            }
          }
          return this.errorCategoria;
        },

        cerrarModal(){ //Cierra totalmente la ventana de registro
          this.modal=0;
          this.tituloModal='';
          this.nombre='';
          this.descripcion='';
          this.errorCategoria=0;
        },

        actualizarCategoria(){
          if(this.validarCategoria()==1){ //Si devuelve 1 entonces tengo 1 error y no guardo los datos en la BD
            return
          }else{
          var me=this;
          axios.put('/categoria/actualizar',{'name':this.nombre,'desc':this.descripcion,'id':this.categoria_id})
          .then(function (response) { //el verbo put sirve para enviar datos que se van a actualizar, como primer parametro la direccion URL a la cual se enviara los datos, y como segundo los datos que se ingresaran en el formulario en forma de variables, cabe decir que las variables tienen que tener el mismo nombre de las que se recibira en el request de la funcion store del controlador
          // En caso de que se guarden los datos en la base de datos hay que ejecutar los siguientes metodos
          me.cerrarModal();
          me.listarCategoria();
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
        }//Fin del else
      },



        abrirModal(modelo, accion, datos=[]){
            switch(modelo){
              case "categoria":
              {
                  switch(accion){
                    case "registrar":
                    {
                      this.modal = 1;
                      this.tituloModal='Registrar Categoria';
                      this.nombre='';
                      this.descripcion='';
                      this.tipoAccion=1;
                      break;
                    }
                    case "actualizar":
                    {
                      this.modal=1;
                      this.tipoAccion=2;
                      this.tituloModal="Actualizar Categoria";
                      this.categoria_id=datos.id;
                      this.nombre=datos.nombre;
                      this.descripcion=datos.descripcion;
                      break;
                    }
                  }

              }
            }

        }
      },
        mounted() {
            this.listarCategoria();
        }
    }
</script>
  <!-- //Codigo CSS -->
<style>
  .modal-content{
    width:100% !important;
    position:absolute !important;
  }
  .mostrar{
    display:list-item !important;
    opacity:1 !important;
    position: absolute !important;
    background-color:#3c29297a !important;
  }

  .div-error{
    display:flex;
    justify-content:center;
  }
  .text-error{
    color:red !important;
    font-weight: bold;
  }
</style>
