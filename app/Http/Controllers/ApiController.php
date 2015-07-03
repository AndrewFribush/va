<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IllResponse;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected $statusCode = IllResponse::HTTP_OK;

    public function getStatusCode(){
        return $this->statusCode;
    }

    public function setStatusCode($statusCode){
        $this->statusCode=$statusCode;
        return $this;
    }

    public function respondNotFound($message = 'Not Found'){

        return $this->setStatusCode(IllResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respond($data, $headers=[]){
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message){
        return $this->respond([
            'error'=>[
                'message'=>$message,
                'status_code'=> $this->getStatusCode
                ]
            ]);
    }

    public function respondCreated($message){
        $this->setStatusCode(IllResponse::HTTP_CREATED)->respond([
                'message'=>$message
                ]);
    }
}
