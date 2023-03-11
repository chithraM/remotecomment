<?php include_once 'main_menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php head('Live Video'); ?>
        <div class="header">
            <img class="center-logo" src="https://touchball.vinfossolutions.com/assets/img/elecramalogo.png" alt="logo_elecrama_recap" width="150px">
            <img class="center-logo" src="https://touchball.vinfossolutions.com/assets/img/ieemalogo.png" alt="logo_elecrama_recap" width="150px">
        </div>
        <video autoplay muted loop id="bg-video">
            <source src="videos/bg-video.webm" type="video/mp4">
        </video>
            <form class="comment-from" method="post" action="" style="color:white;">
                <div class="row">
                    <div class="col-sm-12">
                        <label>Name</label>
                        <input type="text" name="custname" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Message</label>
                        <textarea type="text" name="message" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="savecomment" id="savecomment">Save</button>
                    </div>
                </div>

            </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> 
    <script type="text/javascript">
        $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

        $('#savecomment').on('click',function(e){
            e.preventDefault();
            savecomment();
        })

       // $(document).ready(function() {
            function savecomment(){
                var redurl="comment-ajax.php";
                var data=$('.comment-from').serialize();
                data += '&action=savecomment';
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
           
       // });

    </script>
</body>
</html>