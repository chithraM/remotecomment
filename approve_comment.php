<?php include_once 'main_menu.php';?>

<!DOCTYPE html>
<html lang="en">
<?php head('Live Video'); ?>
<style>
    img.center-logo {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
</style> 
        <img class="center-logo" src="https://touchball.vinfossolutions.com/assets/img/elecramarecap.png" alt="logo_elecrama_recap">
        <video autoplay muted loop id="bg-video">
            <source src="videos/bg-video.webm" type="video/mp4">
        </video>
              <div class="" id="commentlist" style="color:white">  
            </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> 
<script type="text/javascript">
     $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

    $(document).ready(function() {
        function loadcomments(){
            var redurl="comment-ajax.php";
          $.ajax({
           url:redurl,
           method:"GET",
           data:{action:'showpendingcommentlist'},
           cache:false,
           success:function(data)
           {            
            var data_arr = $.parseJSON(data);
            console.log(data_arr['list_comments']); 
              if(data_arr['list_comments']) { 
                var list_comments=data_arr['list_comments']['list_comments'];
                $('#commentlist').html('');
                $.each(list_comments, function( key, value ) {
                    $('#commentlist').append('<p>Name:'+value['customer_name']+'</p>');
                    $('#commentlist').append('<p>Message:'+value['message']+'</p>');
                    $('#commentlist').append('<button type="button" class="approvecomment" id="'+value['id']+'">Approve</button>');
                });
              }                
            }
          });
        }

        loadcomments(); // This will run on page load
        setInterval(function(){           
            loadcomments();// this will run after every 4 seconds
        }, 1000);
    });
    $(document).on('click','.approvecomment',function(e){
            e.preventDefault();
            var id=$(this).attr('id');
            console.log(id);
            savecomment(id);
        })
    function savecomment(id){
          var redurl="comment-ajax.php";
          var data='';
          data += '&action=updatecomment';
          data += '&id='+id;
          $.ajax({
              url:redurl,
              method:"POST",
              data:data,
              cache:false,
              success:function(data)
              {     
                  var data_arr = $.parseJSON(data);
                  console.log(data_arr['error']);
                  if(data_arr['error']==0){
                      $('.comment-from')[0].reset();
                  }
              }
          });
      }
   
</script>
</body>
</html>