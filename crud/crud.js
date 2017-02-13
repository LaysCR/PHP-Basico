//Insert.html
//Successful message after submitting
$(document).ready(function(){
  setTimeout(function() {
    $("#message").fadeOut('slow');
    $("#user-pass").fadeOut('slow');
    $("#error").fadeOut('slow');
}, 2000);
  //Go to next page
  $("#toSelect").click(function(){
    location.href = "../crud/index.php";
  });
});
//Select.php
//Set $value
$(document).ready(function(){
  document.cookie = "value = title";
  $("#sortByTitle").click(function() {
    document.cookie = "value = title";
  })
  $("#sortByAuthor").click(function() {
    document.cookie = "value = author";
  })
  $("#sortByOwner").click(function() {
    document.cookie = "value = owner";
  })
  $("#sortByDescription").click(function() {
    document.cookie = "value = description";
  })
  //Go to next page
  $("#toInsert").click(function(){
    location.href = "../public/insert.php";
  });
  //Delete row
  $(".delete").click(function () {

    var id = $(this).parent().children().val();
    var row = $(this).closest('tr');
    // console.log(id);

    swal({
        title: "Deseja deletar o arquivo?",
        text: "Você não será capaz de recuperar o arquivo após deletado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, deletar!",
        cancelButtonText: "Não, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({
          type: "POST",
          url: "../crud/delete.php",
          data: {
            'id': id
          },
          success: function(data) {
            swal("Deletado!", "Registro do livro deletado com sucesso.", "success");
            row.empty();
          }
        });
      }
      else {
	       swal("Cancelado", "O registro do livro não foi deletado.", "error");
       }
    });

  });

});
