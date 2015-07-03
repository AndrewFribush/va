<?php

namespace App\Http\Controllers;

use App\Request;
use Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RequestsController extends ApiController
{

    function __construct(){

        $this->beforeFilter('auth.basic', ['on'=>'post']);
    }

    public function index()
    {
#        $limit = Input::get('limit') ? 5;
        $limit = 5;
        $requests = Request::paginate($limit);

        return $this->respond([
                'data' => $requests,
                'paginator' =>[
                    'total_count'=> $requests->getTotal(),
                    'current_page'=>$requests->getCurrentPage(),
                    'total_pages'=> ceil($lessons->getTotal()/$lessons->getPerPage()),
                    'limit' => $lessons->getPerPage()
                ]
            ]);
    }

    public function show($id)
    {

        $request = Request::find($id);
        
        if( ! $request ){
            return $this->respondNotFound('Request does not exist');
        } else {
            return $this->respond([
                    'data' => $request
                ]);
        }
    }

    public function store(){
        if(! Input::get('title') or Input::get('body')){
            return $this->setStatusCode(422)->respondWithError('Validation failed');
        } else{
            Request::create(Input::all());
            return $this->respondCreated('Request Created');
        }
    }

}
