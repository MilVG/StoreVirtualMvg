function validarPrin() {
  var userPrin = $("#txtusuarioPrin").val();
  var clavePrin = $("#txtpasswordPrin").val();
  if (userPrin === "" || clavePrin === "") {
    alert("Los campos están Vacios");
    return false;
  }
}
function validarLoVen() {
  var userPrin = $("#txtusuarioVen").val();
  var clavePrin = $("#txtpasswordVen").val();
  if (userPrin === "" || clavePrin === "") {
    alert("Los campos están Vacios");
    return false;
  }
}
