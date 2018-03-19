$(document).ready( function(){

    var results = $("#myvocabbook");
  
    $.post("displayVocabBook.php",
    function(data){
      //display results in index.php 
      results.html(data);
    });


    $('#login_form').submit( function(event) {
      alert("submit handler called");
        event.preventDefault();
        var are_all_inputs_filled = true;

        var $login_username = $("input[name='login_username']").val().trim();

        if($login_username.length === 0){
            are_all_inputs_filled = false;
            $login_username.parent().attr('class','form-control has-error');
            $login_username.next().html('Please provide your username.');
            //add "has-error" to the input class so its highlighted in red and prompt for input
        }

        var $login_password = $("input[name='login_password']").val().trim();

        if($login_password.length === 0){
            are_all_inputs_filled = false;
            $login_password.parent().attr('class','form-control has-error');
            $login_password.next().html('We can\'t log you in without a password.');
            //add "has-error" to the input class so its highlighted in red and prompt for input
        }

        if(are_all_inputs_filled){
          alert("Username: " + $login_username + " Password: " + $login_password);
            //use ajax post to submit the username and password to login.php for validation
            $.post("login.php",
            {
              username: $login_username,
              password: $login_password
            });
        }
        return false;
    });


    $('#registration_form').submit( function (event) {  
        event.preventDefault();
        var are_all_inputs_filled = true;

        //validate given username and password, then submit to register.php
        var $reg_username = $("input[name='reg_username']").val().trim();
        if($reg_username.length === 0){
            are_all_inputs_filled = false;
            //add "has-error" to the input class so its highlighted in red and prompt for input
        }
        var $reg_password = $("input[name='reg_password']").val().trim();
        if($reg_password.length === 0){
            $are_all_inputs_filled = false;
            //add "has-error" to the input class so its highlighted in red and prompt for input
        }
        var $reg_password_conf = $("input[name='reg_confirm_password']").val().trim();
        if($reg_password_conf.length === 0){
            are_all_inputs_filled = false;
            //add "has-error" to the input class so its highlighted in red and prompt for input
        }
        if(are_all_inputs_filled){
            //use ajax post to submit the username and password to login.php for validation
        }
        return false;
    })
  
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
  
    
});