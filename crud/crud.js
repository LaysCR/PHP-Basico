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
  deleteRow();

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
  $("#sortByPublisher").click(function() {
    document.cookie = "value = name";
  })
  $("#sortByDescription").click(function() {
    document.cookie = "value = description";
  })
  //Go to next page
  $("#toInsert").click(function(){
    location.href = "../public/insert.php";
  });
  //Delete row
  function deleteRow(){
    $(".delete").on('click', function () {

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

  }
  //Insert.php->Modal&Ajax
  $("#form-insert").on('submit', function(e){
    e.preventDefault();
    var title = $("#title").val();
    var author = $("#author").val();
    var publisher = $("#publisher").val();
    var owner = $("#owner").val();
    var description = $("#description").val();
    var data = {
      'title': title,
      'author': author,
      'publisher': parseInt(publisher),
      'owner': owner,
      'description': description
    };
      $.ajax({
        type : "POST",
        url : "../crud/insert.php",
        data : data,
        success: function(data) {
          var row = "<tr>" +
                      "<td>"+ data.title +"</td>" +
                      "<td>"+ data.author +"</td>" +
                      "<td>"+ data.publisher +"</td>" +
                      "<td>"+ data.owner +"</td>" +
                      "<td>"+ data.description +"</td>" +
                      "<td><a class='update btn' href='#' type='submit' title='Atualizar'><span class='glyphicon glyphicon-pencil'></span></a></td>" +
                      "<td>" +
                      "<form method='post'>" +
                      "<input class='teste' type='hidden' value="+ data.id +">" +
                      "<a class='delete btn' href='#' title='Deletar' type='submit'><span class='glyphicon glyphicon-trash'></span></a></td>" +
                      "</form>" +
                    "</tr>";

            $("#table").append(row);
            $("#exampleModal").modal("hide");
            deleteRow();

            Command: toastr["success"]("Livro cadastrado com sucesso !")
              toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": true,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "3000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }

        }
      });

  });
// Tag
  $(".js-example-basic-multiple").select2();
  $(".js-example-basic-hide-search").select2({
    minimumResultsForSearch: Infinity
  });
//Clear Modal
  $("#exampleModal").on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

  });
//Exit
});
