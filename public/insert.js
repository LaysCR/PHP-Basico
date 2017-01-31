// $(document).ready(function(){
//
//     $("#message").hide();
//
// });

$(document).ready(function(){
  $("#message").hide();
  $("#button").click(function(){
    $("#message").show();
    $("#message").hide(3000);
  });
});
