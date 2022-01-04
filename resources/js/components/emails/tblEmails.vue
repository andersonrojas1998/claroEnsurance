<template>
  <div>
<br>
<div class="row">      
    <div class="col-lg-12">
      <div class="table-responsive">
        <table          
        id="dt_email"
          class="table table-striped table-bordered "
          style="width: 100%"          
        >
          <thead>
            <tr class="bg-secondary">              
              <th>#</th>
              <th>Asunto</th>
              <th>Destinatario</th>
              <th>Cuerpo</th>              
              <th>Estado</th>                            
            </tr>
          </thead>
          <tbody>
              <tr v-for="(v,i) in emails" :key="i">                                  
                  <td>{{ v.id }}</td>                
                   <td>{{ v.asunto }}</td>                
                  <td>{{ v.destinario }}</td>                
                  <td>{{ v.cuerpo }}</td>                  
                  <td> <label :class="(v.status==0)? 'btn-danger':'btn-success'" class="btn btn-sm btn-inverse ">{{ (v.status==0)? 'No Enviado':'Enviado' }}</label> </td>                                                   
              </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
</div>

</template>
<script>
export default {   
  title: "Emails",   
    data: () => ({
    emails: [],   
  }),
  created() {
    this.getEmails();
  }, 
  methods: {
          
    getEmails() {

      this.$http.get("/emails/listData").then((res) => {
        let d = res.data;
        this.emails = d;
         this.$nextTick(() => {
                        $("#dt_email").DataTable({
                            responsive: true,
                            orderable: true,
                            destroy: true,                                               
                        });
                    });
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
