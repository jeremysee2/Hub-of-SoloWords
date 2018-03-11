window.onload = function(){

  var ourRequest = new XMLHttpRequest();
  ourRequest.open('POST','displayVocabBook.php');
  ourRequest.onreadystatechange = function () {
    //function to be executed when a response is received
    $('.myvocabbook').html = ourRequest.responseText;
  };
  ourRequest.send(); //send request


  $('.submitSearch').click( function () {
  var searchfield = $('.searchfield').val;
  var ourSearchString = "searchfield=" + searchfield;
  ourRequest.open('POST', 'displayVocabBook.php',true);
  ourRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //To tell that we are sending our data in the format key=value.
  ourRequest.onreadystatechange = function() {
    //function to be executed when a response is received
    if(ourRequest.readyState == 4 && ourRequest.status == 200) {
        var return_data = ourRequest.responseText;
        $('.myvocabbook').html= return_data;
    }
  }
  ourRequest.send(ourSearchString); // Actually execute the request
  });

}
$('.collapse').collapse();

