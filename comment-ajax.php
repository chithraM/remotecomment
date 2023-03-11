<?php include_once 'functions.php';
$action=$_REQUEST['action'];
if($action=='savecomment'){
    $data=[];
    $name=$_REQUEST['custname'];
    $message=$_REQUEST['message'];
    if($name!=''){
        $sql="insert into tblcomments (customer_name,message) values('$name','$message')";
        $result=mysqli_query($conn,$sql);
    }
    
    echo json_encode(['error'=>0,'msg'=>'Saved Successfully']);
    exit;
}
else if($action=='updatecomment'){
    $data=[];
    $id=$_REQUEST['id'];
    if($id!=''){
        $sql="update tblcomments set status='1' where id='$id'";
        $result=mysqli_query($conn,$sql);
    }
    
    echo json_encode(['error'=>0,'msg'=>'Saved Successfully']);
    exit;
}
else if($action=='showpendingcommentlist'){
    $data=[];
	$list_comments=listcomments('','0');				
	if(count($list_comments)>0){
		$data['list_comments']=$list_comments;
    }

    echo json_encode(['list_comments'=>$data,'error'=>0]);
    exit;
}
else if($action=='showcommentlist'){
    $data=[];
	$list_comments=listcomments('','1');				
	if(count($list_comments)>0){
		$data['list_comments']=$list_comments;
    }

    echo json_encode(['list_comments'=>$data,'error'=>0]);
    exit;
}