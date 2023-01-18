<?php
namespace App\Http;
 class NotificationHelper {
 
    // public function __construct($message,$alertType){
    //     $notifi=array('message'=>$message,'alert-type'=>$alertType);
    //     return $notifi;
    // }
    public function ShowNotification($message,$alertType) {
        $notifi=array('message'=>$message,'alert-type'=>$alertType);
        return $notifi;
    }
}
?>