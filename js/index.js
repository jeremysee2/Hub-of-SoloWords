/*
  @file

  Last modification: 12 March 2018

  This js file queries the word database through displayVocabBook.php,
  allowing registered users to search for words in their vocabulary book.

*/

$(document).ready( function(){

  var results = $("#myvocabbook");

  $.post("displayVocabBook.php",
  function(data){
    //display results in index.php 
    results.html(data);
  });


  $('.submitSearch').click( function () {

    var inputVal = $(this).val();
    
    $.post("displayVocabBook.php",
    {
      searchfield: inputVal
    },
    function(data){
      //display results in index.php 
      results.html(data);
    });
  });


  $('#searchfield').keyup( function(){
    /* Get input value on change */
    var inputVal = $(this).val();

    if(inputVal.length){

      $.post("displayVocabBook.php",
      {
        searchfield: inputVal,
      },
      function(data){
        //display results in index.php 
        results.html(data);
      });

    } else{ //What to do when searchfield is empty - display all results in index.php

      $.post("displayVocabBook.php",
      function(data){ 
        //display results in index.php 
        results.html(data);
      });
      
    }
  });

  $('.collapse').collapse({'toggle':false});
  $('.collapse.in').collapse('hide');
  $('.collapse').collapse('show');
  
});

