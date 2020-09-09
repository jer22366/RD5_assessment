<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
        $.ajax({
                type:"POST",
                url:"test.php",
                data:{
                        "value":1
                        }
                }).then(function(e){
                        alert(e)
        }) 
})        
</script>