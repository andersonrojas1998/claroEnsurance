<template>
  <div class="row">
    <div class="col-lg-5 ml-5 offset-2">
      <div class="card card-border-outset mb-3">
        <img
          class="card-img-top img-circle"
          src="/images/print.png"
          height="60"
          alt="Imprimir"
          style="width: 100px; align-self: center; margin: 12px"
        />
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <ul class="list-group">
                <li class="list-group-item">
                  <strong class="col-lg-12">Asunto:</strong>
                  <input
                    type="text"
                    class="form-control"
                    v-model="numero"
                    maxlength="200"
                  />
                </li>
                <li class="list-group-item">
                  <strong class="col-lg-12">Destinatario:</strong>
                  <input
                    type="email"
                    class="form-control"
                    maxlength="45"
                    v-model="cantidad"
                  />
                </li>

                <li class="list-group-item">
                  <strong class="col-lg-12">Cuerpo:</strong>
                  <textarea
                    class="form-control"
                    rows="5"
                    maxlength="255"
                  ></textarea>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-lg-12">
              <button
                type="button"
                @click="save"
                class="btn btn-info btn-block btn-rounded"
                id="prt_bulletinStudent"
                data-toggle="tooltip"
                data-placement="top"
                title="Genera el boletin en formato PDF"
              >
                ENVIAR
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  title: "Claro | Invoice",
  data: () => ({
    productos: [],
    numero: "",
    cantidad: "",
    total: "",
    sel_prod: "",
  }),
  methods: {
    save() {
      sweetMessageTimeOut(
        "Procesando ...",
        "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
        3000
      );

      this.$http
        .post("/invoice/created", {
          numero: this.numero,
          cantidad: this.cantidad,
          total: this.total,
          id_prod: this.sel_prod,
        })
        .then((res) => {
          if (res.status == 201) {
            sweetMessage(
              "\u00A1Registro exitoso!",
              "\u00A1 Se ha realizado con \u00E9xito su solicitud!"
            );
            window.location.replace("/invoice/inicio");
          }
        });
    },
    getProductos() {
      this.$http.get("/productos/getProductos").then((res) => {
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
