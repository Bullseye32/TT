<?php
namespace App\Helper;


/**
 *
 */
class Tools
{

    public static function setResponse($type,$message,$data,$meta)
    {
        if ($type=='success') {
            $error = false;
        }
        elseif($type=='fail'){
            $error = true;
        }

        $responseData = [
            'error' => $error,
            'message'=>$message,
            'data' => $data,
            'meta' => $meta
        ];
        return $responseData;

    }




}
