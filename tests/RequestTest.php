<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends ApiTester
{
    public function it_fetches_requests(){
        $this->getJson('api/v0/requests');
        $this->assertResponseOk();
    }

    public function it_fetches_single_request(){
        $lesson = $this->getJson('api/v0/requsts/1')->data;
        $this->assertResponseOK;
    }

    private function makeRequests($requestFields = []){
        $request =array_merge([
                'company' => $this->faker->sentence,
                'request' => $this->faker->paragraph
            ] $requestFields);

        Request::create($request);
    }

    private function getJson($uri){
        return json_decode($this->call('GET', $uri)->getContent());
    }
}
