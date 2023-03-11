<?php include_once 'db.php';


function listcomments($id='',$status=0){
    global $conn;
    $list_comments=[];
    $where='where ';
    $where .=$id!=''?"id='$id' and ":'';
    $where .=$status!=''?"status='$status' and ":'';
    $where .=" 1";
    $sql="select * from tblcomments $where  order by modified_at asc";
    $result=mysqli_query($conn,$sql);
    if($result && mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_object($result)){
            $list_comments[]=$row; 
        }
    }
    return $list_comments;
}