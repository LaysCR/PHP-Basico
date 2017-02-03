//Insert.html
//Successful message after submitting
$(document).ready(function(){
  setTimeout(function() {
    $("#message").fadeOut('slow');
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

});
