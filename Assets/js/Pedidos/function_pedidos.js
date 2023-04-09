let tablePedidos;
tablePedidos = $("#datatblPedidos").DataTable({
  select: true,
  aProcessing: true,
  aServerSide: true,
  language: {
    url: "" + BASE_URL + "Assets/vendor/plugins/datatableEspañol.json",
  },
  ajax: {
    url: "" + BASE_URL + "Pedidos/getPedidos",
    dataSrc: "",
  },
  columns: [
    { data: "id_pedidos" },
    { data: "referenciacobro" },
    { data: "fecha" },
    { data: "monto" },
    { data: "tipopago" },
    { data: "status" },
    { data: "options" },
  ],
  columnDefs: [
    { className: "textcenter", targets: [3] },
    { className: "textright", targets: [4] },
    { className: "textcenter", targets: [5] },
  ],
  dom: "lBfrtip",
  buttons: [
    {
      extend: "copyHtml5",
      text: "<i class='far fa-copy'></i> Copiar",
      titleAttr: "Copiar",
      className: "btn btn-secondary",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
    },
    {
      extend: "excelHtml5",
      text: "<i class='fas fa-file-excel'></i> Excel",
      titleAttr: "Esportar a Excel",
      className: "btn btn-success",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
    },
    {
      extend: "pdfHtml5",
      text: "<i class='fas fa-file-pdf'></i> PDF",
      titleAttr: "Esportar a PDF",
      className: "btn btn-danger",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
    },
    {
      extend: "csvHtml5",
      text: "<i class='fas fa-file-csv'></i> CSV",
      titleAttr: "Esportar a CSV",
      className: "btn btn-info",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
    },
    {
      extend: "print",
      text: "<i class='fa fa-print' aria-hidden='true'></i>Impresión",
      titleAttr: "Esportar a CSV",
      className: "btn btn-dark",
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5],
      },
    },
  ],
  resonsieve: "true",
  bDestroy: true,
  iDisplayLength: 10,
  order: [[0, "asc"]],
});
