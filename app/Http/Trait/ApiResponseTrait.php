<?php
namespace App\Http\Trait;
trait ApiResponseTrait{
public function apiresponse($data=null,$message=null,$status=null){
    $array=[
        'data'=>$data,
        'message'=>$message,
        'status'=>$status,
        ];
        return response($array,$status);
}
}

?>
