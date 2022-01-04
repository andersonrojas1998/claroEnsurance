<template>
  <div class="row">
    <div class="col-lg-1 offset-11">
      <button
        class="btn btn-success btn-xs"
        data-toggle="modal"
        data-target="#mdl_created_user"
      >
        <i class="mdi mdi-account-multiple-plus fz"></i>
      </button>
    </div>

    <div class="col-lg-12">
      <div class="table-responsive">
        <table
          id="dt_users"
          class="table table-striped table-bordered"
          style="width: 100%"
        >
          <thead>
            <tr class="bg-secondary">
              <th>#</th>
              <th>Identificacion</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Años</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(v, i) in users" :key="i">
              <th>{{ v.id }}</th>
              <td>{{ v.identificacion }}</td>
              <td>
                <div v-if="!v.editable">
                  {{ v.name }}
                </div>
                <div v-else>
                  <input type="text" class="form-control" :value="v.name" />
                </div>
              </td>
              <td>{{ v.email }}</td>
              <th>{{ v.years }}</th>
              <th>
                <div v-if="v.estado == 1">
                  <p class="text-success">Activo</p>
                </div>
                <div v-else>
                  <p class="text-danger">Inactivo</p>
                </div>
              </th>
              <td>
                <div v-if="v.editable">
                  <button
                    class="btn btn-success btn-xs"
                    @click="btn_edit_user(v, $event)"
                  >
                    <i class="mdi mdi-content-save-settings fz"></i>
                  </button>
                  <button
                    class="btn btn-warning btn-xs"
                    @click="btn_edit(v, false)"
                  >
                    <i class="mdi mdi-content-duplicate fz"></i>
                  </button>
                </div>
                <div v-else>
                  <button
                    class="btn btn-primary btn-xs"
                    @click="showUser(v)"
                    data-toggle="modal"
                    data-target="#mdl_showinfo"
                  >
                    <i class="mdi mdi-account-search-outline fz"></i>
                  </button>
                  <button
                    class="btn btn-success btn-xs"
                    @click="btn_edit(v, true)"
                  >
                    <i class="mdi mdi-account-settings fz"></i>
                  </button>
                  <button
                    class="btn btn-danger btn-xs"
                    @click="btn_delete(v.id, i)"
                  >
                    <i class="mdi mdi-delete-forever fz"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!--  -->
    <div
      class="modal fade"
      id="mdl_showinfo"
      tabindex="-1"
      role="dialog"
      aria-labelledby="mdl_showinfo"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-center d-block">INFO PERSONAL</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-striped table-responsive">
                  <thead>
                    <tr class="text-center">
                      <th>#</th>
                      <th>Identificacion</th>
                      <th>Nombre</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="text-center">
                      <td>{{ objUser.id }}</td>
                      <td>{{ objUser.identificacion }}</td>
                      <td>{{ objUser.name }}</td>
                      <td>{{ objUser.email }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  -->
    <div
      class="modal fade"
      id="mdl_created_user"
      tabindex="-1"
      role="dialog"
      aria-labelledby="mdl_created_user"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-white-100 p-30">
          <div class="modal-header">
            <h5 class="modal-title">CREACI&Oacute;N PERSONAL</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-4">
                <label
                  >Identificaci&oacute;n : <span class="text-danger">*</span>
                </label>
                <input type="number" class="form-control" v-model="dni" />
              </div>
              <div class="col-lg-4">
                <label>Nombre : <span class="text-danger">*</span></label>
                <input
                  type="text"
                  maxlength="100"
                  class="form-control"
                  v-model="name"
                />
              </div>
              <div class="col-lg-4">
                <label>Email : <span class="text-danger">*</span></label>
                <input type="email" class="form-control" v-model="email" />
              </div>

              <div class="col-lg-4">
                <label>Contraseña : <span class="text-danger">*</span></label>
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  placeholder="Password"
                />
              </div>
              <div class="col-lg-4">
                <label
                  >Verificar Contraseña :
                  <span class="text-danger">*</span></label
                >
                <input
                  type="password"
                  class="form-control"
                  v-model="vpassword"
                  v-on:keyup="validatePassword"
                />
                <p class="text-danger">
                  {{ !error ? "Contraseñas No coinciden" : "" }}
                </p>
              </div>

              <div class="col-lg-4">
                <label>Celular : <span class="text-danger">*</span></label>
                <input
                  type="number"
                  class="form-control"
                  v-model="phone"
                  min="0"
                />
              </div>

              <div class="col-lg-4">
                <label
                  >Fecha Nacimiento : <span class="text-danger">*</span></label
                >
                <input type="date" class="form-control" v-model="birthday" />
              </div>

              <div class="col-lg-4">
                <label>Cod Ciudad : <span class="text-danger">*</span></label>
                <input
                  type="number"
                  class="form-control"
                  v-model="codCity"
                  min="0"
                />
              </div>
              <hr />
            </div>
            <p class="text-danger p-30">
              Todos los campos con (*) son obligados.
            </p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              :class="!error ? 'disabled' : ''"
              class="btn btn-success"
              @click="saveUser"
            >
              Guardar
            </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  title: "Claro | Usuarios",
  data: () => ({
    users: [],
    objUser: {},
    dni: "",
    name: "",
    email: "",
    password: "",
    vpassword: "",
    phone: "",
    birthday: "",
    error: true,
    codCity: "",
  }),
  created() {
    this.getUsers();
  },
  methods: {
    showUser(v) {
      this.objUser = v;
    },
    validatePassword() {
      this.error = this.password == this.vpassword ? true : false;
    },
    saveUser() {
      let param = {
        dni: this.dni,
        name: this.name,
        email: this.email,
        password: this.password,
        phone: this.phone,
        codCity: this.codCity,
      };
      if (
        this.error &&
        this.dni != "" &&
        this.name != "" &&
        this.email != "" &&
        this.password != "" &&
        this.vpassword
      ) {
        this.$http
          .post("/users/create", param)
          .then((res) => {
            if (res.status == 201) {
              sweetMessage(
                "\u00A1Registro exitoso!",
                "\u00A1 Se ha realizado con \u00E9xito su solicitud!"
              );
              this.users.push(res.data.user);
              $("#mdl_created_user").modal("hide");
            } else if (res.status == 400) {
              sweetMessage(
                "ERROR!",
                "El usuario ya se encuentra registrado",
                "error"
              );
            }
          })
          .catch(function (error) {
            sweetMessage(
              "ERROR!",
              "El usuario ya se encuentra registrado",
              "error"
            );
          });
      } else {
        sweetMessage(
          "ATENCION!",
          "Por favor los campos obligatorios (*)",
          "error"
        );
      }
    },
    getUsers() {
      this.$http.get("/users/listData").then((res) => {
        let d = res.data;
        this.users = d;
        this.$nextTick(() => {
          $("#dt_users").DataTable({
            responsive: true,
            orderable: true,
            destroy: true,
            /*ajax: {
                                url: '',
                                type: 'get',
                                        dataSrc: function (json) {
                                    if (!json.data) {
                                        return [];
                                    } else {
                                        return json.data;
                                    }}
                              },
                              columns: [
                                {data: 'c'},
                              ],*/
          });
        });
      });
    },
    btn_edit_user(v, event) {
      sweetMessageTimeOut(
        "Procesando ...",
        "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
        3000
      );
      var name =
        event.target.parentNode.parentNode.parentNode.parentNode.children[2]
          .firstElementChild.firstElementChild.value;

      this.$http.post("/users/update", { name: name, id: v.id }).then((res) => {
        if (res.status == 201) {
          v.name = name;
          v.editable = false;
        }
      });
    },
    btn_edit(v, state) {
      v.editable = state;
    },
    btn_delete(id, i) {
      sweetMessageTimeOut(
        "Procesando ...",
        "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
        5000
      );
      this.$http.get("/users/delete/" + id).then((res) => {
        if (res.status == 201) {
          this.users.splice(i, 1);
        }
      });
    },
  },
};
</script>
<style scoped>
.fz {
  font-size: 22px !important;
}
.bg-white-100 {
  background-color: white;
}
.p-30 {
  padding: 30px;
}
</style>
