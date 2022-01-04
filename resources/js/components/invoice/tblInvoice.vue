<template>
  <div class="row">

    <div class="col-lg-4">
        <label>Fecha Consulta:</label>
    <input type="date"  class="form-control" v-model="date">  
    </div>  

    <div class="col-lg-2 mb-5">
        <button class="btn btn-success btn-xs" @click="search" ><i class="mdi mdi mdi-account-search fz"></i></button>        
    </div>
      
    <div class="col-lg-12">
      <div class="table-responsive">
        <table
        
          class="table table-striped table-bordered"
          style="width: 100%"
        >
          <thead>
            <tr class="bg-secondary">        
                <th>#</th>  
                <th>Numero</th>              
                <th>Fecha</th>  
                <th>Cantidad</th>            
                <th>Total</th>                              
            </tr>
          </thead>
          <tbody>
              <tr v-for="(v,i) in productos" :key="i">                
                <th>{{ v.id }}</th>
                <td>{{ v.numero }}</td>
                <td>{{ v.fecha }}</td>                
                <td>{{ v.cantidad }}</td>                
                <td>$ {{ v.total }}</td>           
              </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {   
  title: "AdaSoft | Productos",
  data: () => ({
    productos: [],        
    date:'',        
  }),
  created(){
    this.getProductos();
  },
  methods: {
          

search(){

    sweetMessageTimeOut(
        "Procesando ...",
        "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
        3000
    );

    this.$http.get("/invoice/getInvoiceDate/"+this.date)
        .then((res) => {
          let d = res.data;          
          this.productos = d;
        });
    
},
    getProductos(){
       this.$http.get("/invoice/getInvoice")
        .then((res) => {
          let d = res.data;          
          this.productos = d;
        });
    },        
  },
};
</script>
<style scoped>
.fz {
font-size: 22px !important;
}
</style>
