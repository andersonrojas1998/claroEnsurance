!function (e) { "function" == typeof define && define.amd ? define(["jquery", "../jquery.validate"], e) : "object" == typeof module && module.exports ?
module.exports = e(require("jquery")) : e(jQuery) }(function (e) { return e.extend(e.validator.messages, { required: "Este campo es obligatorio.", remote:
"Por favor, rellena este campo.", email: "Por favor, escribe una dirección de correo válida.", url: "Por favor, escribe una URL válida.", date:"Por favor, escribe una fecha válida.", dateISO: "Por favor, escribe una fecha (ISO) válida.", number: "Por favor, escribe un número válido.", digits: "Por favor escribe sólo dígitos.", creditcard: "Por favor, escribe un número de tarjeta válido.", equalTo: "Por favor, escribe el mismo valor de nuevo.", extension:
"Por favor, escribe un valor con una extensión aceptada.", maxlength: e.validator.format("Por favor, no escribas más de {0} caracteres."), minlength: e.validator.format("Porfavor, no escribas menos de {0} caracteres."), rangelength: e.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."), range: e.validator.format("Por favor, escribe un valor entre {0} y {1}."), max: e.validator.format("Por favor,  escribe un valor menor o igual a {0}."), min: e.validator.format("Por favor, escribe un valor mayor o igual a {0}."), nifES: "Por favor, escribe un NIF válido.", nieES: "Por favor, escribe un NIE válido.", cifES: "Por favor, escribe un CIF válido." }), e });