$(document).ready(function() {


    $("#search").keyup(function() {

 
        var name = $('#search').val();


        if (name === "") {


            $("#display").html("");

        }
        else {


            $.ajax({

                type: "POST", 
                url: "script.php", 
                data: {
                    
                    search: name 
                },
                success: function(response) {
                    
                    $("#display").html(response).show();
                }

            });

        }

    });

});

function fill(Value) {


    $('#search').val(Value); 

    $('#display').hide(); 

}
