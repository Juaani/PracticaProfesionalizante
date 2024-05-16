 // JavaScript para mostrar los modales al hacer clic en los botones
 document.getElementById("ofertasModalBtn").addEventListener("click", function() {
    var myModal = new bootstrap.Modal(document.getElementById('ofertasModal'), {});
    myModal.show();
});

document.getElementById("contactoModalBtn").addEventListener("click", function() {
    var myModal = new bootstrap.Modal(document.getElementById('contactoModal'), {});
    myModal.show();
});
  
  