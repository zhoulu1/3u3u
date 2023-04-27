<?php
function jsonData($status , $msg , $data = []){

    return response()->json(['code' => $status,'msg' => $msg,'data' => $data]);
    
}