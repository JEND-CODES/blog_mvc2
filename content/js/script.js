//Fonctionnalités JS du framework Materialize 

$(document).ready(function () {
    //Materialize animations
    $('.sidenav').sidenav();
    $('.fixed-action-btn').floatingActionButton();
    $('.dropdown-trigger').dropdown();
    $('.scrollspy').scrollSpy();
    $('.tabs').tabs();
    
    //To hide comments on chapters
    $( "#ghost2" ).hide();
    $( "#ghost3" ).hide();
   
});

$( "#ghost" ).click(function() {
  $( "#ghost2" ).slideToggle( "slow", function() {
    // Show max 5 comments
  });
    $( "#ghost1" ).toggle( "slow", function() {
    // Show All comments
  });
    $( "#ghost3" ).toggle(function() {
    // Change message button
  });
    $( "#ghost4" ).toggle(function() {
    // Change message button
  });
});


 

