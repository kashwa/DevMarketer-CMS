<?php

namespace App\Http\Controllers\Api;

/**
 * Trait used to return response in a standard Format:
 * 
 * [
 *  'data' =>
 *  'status' => true, false
 *  'error' =>
 * ]
 * 
 */
trait ApiResponse{

  /**
   * apiResponse() return all APIs with a standard Response;
   *
   * @param [type] $data
   * @param [type] $error
   * @param integer $status_code
   * @return void
   */
  public function apiResponse($data = null, $error = null, $status_code = 200){
    $array = [
      'Data'    =>  $data,
      'status'  =>  $status_code == 200 ? true : false,
      'error'   =>  $error
    ];

    return response($array, $status_code);
  }

  public function notFoundResponse(){
    $msg = "Your item might be deleted or not found!";
    return $this->apiResponse(null, $msg, 404);
  }

  public function foundDeleteResponse(){
    return $array = [
      'Data'    =>  'Your Item is Deleted, Successfully!',
      'status'  =>  true,
      'error'   => null
    ];
  }

  public function notFoundDeleteResponse(){
    return $array = [
      'Data' => null,
      'status' => false,
      'error' => 'Item might be deleted or not found'
    ];
  }

}
