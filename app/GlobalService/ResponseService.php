<?php
    namespace App\GlobalService;
 
    class ResponseService{
    public function responseBladeError($message = 'Opps!!!. Something Went Wrong!!'){
        return redirect()->back()->with('error', $message);
    }
    public function responseBladeSuccess($message = 'Success!!!'){
        return redirect()->back()->with('success', $message);
    }
  }

?>