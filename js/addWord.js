window.onload = function(){

  $('.addWordButton').click(function(){
    var wordToAdd = $('.wordToAdd').val;
    var ourRequest = new XMLHttpRequest();
    ourRequest.open('POST', 'addWord.php');
    var wordToAddSeq = "wordToAdd=" + wordToAdd;
    ourRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //sending data in format of key=value
    ourRequest.onreadystatechange = function () {
      //function to be executed when a response is received
      if(ourRequest.readyState == 4 && ourRequest.status == 200) {
          var return_data = ourRequest.responseText;
          document.getElementById("successStatus").innerHTML = return_data;
      }
    }
    ourRequest.send(wordToAddSeq);
  });


}
