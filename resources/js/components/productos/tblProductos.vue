<template>
  <div class="row">



    <div class="col-lg-2 offset-10">
        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#mdl_stock"><i class="mdi mdi mdi-access-point fz"></i></button>
        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#mdl_created_task"><i class="mdi mdi-account-multiple-plus fz"></i></button>
    </div>
      
    <div class="col-lg-12">
      <div class="table-responsive">
        <table
          id=""
          class="table table-striped table-bordered"
          style="width: 100%"
        >
          <thead>
            <tr class="bg-secondary">        
                <th>#</th>  
              <th>Nombre</th>              
              <th>Descripcion</th>  
              <th>Imagen</th>            
              <th>Precio</th>              
              <th>Cant. Min</th>             
            </tr>
          </thead>
          <tbody>
              <tr v-for="(v,i) in productos" :key="i">                
                <th>{{ v.id }}</th>
                <td>{{ v.nombre }}</td>
                <td>{{ v.descripcion }}</td>
                <td><img :src="'/images/'+v.imagen"></td>
                <td>{{ v.precio }}</td>                
                <td>{{ v.cantidad_minima }}</td>           
              </tr>
          </tbody>
        </table>
      </div>
    </div>


<!--  -->
<div class="modal fade" id="mdl_created_task" tabindex="-1" role="dialog" aria-labelledby="mdl_created_task" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="background:white;">
      <div class="modal-header">
        <h5 class="modal-title text-primary" >CREACI&Oacute;N PRODUCTOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form enctype="multipart" method="post" name="form_productos" id="form_productos">
        <div class="row">
            
            <div class="col-lg-6">
                <label>Nombre :  <span class="text-danger">*</span> </label>
                <input type="text" name="nombre" class="form-control">
            </div>
            <div class="col-lg-6">
                <label>Descripcion :  <span class="text-danger">*</span> </label>                
                <input type="text" name="descripcion" class="form-control" >
            </div>
            <div class="col-lg-6">
                <label>Precio  :  <span class="text-danger">*</span> </label>                
                <input type="number" name="precio" class="form-control" >
            </div>
            <div class="col-lg-6">
                <label>Imagen  :  <span class="text-danger">*</span> </label>                
                <input type="file" name="imagen" >
            </div>
            <div class="col-lg-6">
                <label>Cantidad Minima :  <span class="text-danger">*</span></label>                
                <input type="number"  name="cant_min" class="form-control">
            </div>                                   
        </div>
         </form>            
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-success" @click="saveProductos">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>    
    </div>
  </div>
  </div>
  <!--  -->


  <div class="modal fade" id="mdl_stock" tabindex="-1" role="dialog" aria-labelledby="mdl_created_task" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="background:white;">
      <div class="modal-header">
        <h5 class="modal-title text-primary" >PRODUCTOS STOCK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form enctype="multipart" method="post" name="form_productos" id="form_productos">
        <div class="row">            
            <div class="col-lg-6">
                <label>Item :  <span class="text-danger">*</span> </label>
                <select style="width:100%" v-model="sel_item">
                    <option></option>
                    <option v-for="(e,i) in productos" :key="i" :value="e.id">
                        {{ e.nombre }}
                    </option>

                </select>
            </div>            
            <div class="col-lg-6">
                <label>Cantidad :  <span class="text-danger">*</span></label>                
                <input type="number"  v-model="cantidad" class="form-control">
            </div>                                   
        </div>
         </form>            
      </div>  
      <div class="modal-footer">
        <button type="button" class="btn btn-success" @click="btn_edit">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>    
    </div>
  </div>
  </div>

  </div>
</template>
<script>
export default {   
  title: "AdaSoft | Productos",
  data: () => ({
    productos: [],    
    sel_item:'',
    descripcion:'',
    cantidad:''
    
  }),
  created(){
    this.getProductos();
  },
  methods: {
          

saveProductos(){

    var formData = new FormData($("#form_productos")[0]);

        sweetMessageTimeOut(
        "Procesando ...",
        "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
        3000
      );
        this.$http
                .post("/productos/saveItems",formData)
                .then((res) => {
                if(res.status==201){
                    sweetMessage(
                    "\u00A1Registro exitoso!",
                    "\u00A1 Se ha realizado con \u00E9xito su solicitud!"
                    );
                    this.productos.push(res.data.producto);
                    $('#mdl_created_task').modal('hide');

                }else if (res.status==400){ 
                    sweetMessage("ERROR!","Error" + res.status, "error");
                }
                
                }).catch(
    function (error) {      
       sweetMessage("ERROR!","Error" + res.status, "error");
    }
  );
},
    getProductos(){
       this.$http.get("/productos/getProductos")
        .then((res) => {
          let d = res.data;          
          this.productos = d;
        });
    },
    btn_edit(){ 
        
        sweetMessageTimeOut(
            "Procesando ...",
            "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
            3000
      );       
        
        this.$http
        .post("/productos/stock",{item:this.sel_item,cantidad:this.cantidad})
        .then((res) => {
          if(res.status==201){
              $('#mdl_stock').modal('hide');           
          }
          
        });

    },
    /*btn_edit(v,state){
        v.editable=state;
    },*/
    /*btn_delete(id,i){
        sweetMessageTimeOut(
            "Procesando ...",
            "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
            5000
      );
      this.$http
        .get("/task/delete/"+id)
        .then((res) => {                    
          if(res.status==201){
            this.task.splice(i,1);
          }
          
        });
    }   */ 
  },
};
</script>
<style scoped>
.fz {
font-size: 22px !important;
}
</style>
