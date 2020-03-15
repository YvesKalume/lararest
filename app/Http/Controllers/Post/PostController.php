<?php

namespace App\Http\Controllers\Post;

use App\Post;
use Faker\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private $faker;

    /**
     * CountryController constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $posts = Post::get();
        return response()->json($posts);
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function show($id){

        $post = Post::find($id);
        if ($post!=null){
            return response()->json($post);
        }
        else {
            return $this->generatePost($id);
        }
    }


    public function generatePost($id){
        $id = intval($id);
        if ( $id > 0) {
            $post = [
                'id'=>$id,
                'user_id'=>$this->faker->numberBetween(1,5),
                'title'=> $this->faker->words('3',true),
                'content'=>$this->faker->sentences('5',true)
            ];

            $post = Post::create($post)->id;

            return redirect('api/post/'.$post);
        }
        else {
            return response('Not found',404);
        }
    }
}
