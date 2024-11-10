<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\Utility;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;
    protected $service;
    public function __construct(Post $post, Utility $service){
        $this->post = $post;
        $this->service = $service;
    }
    // return $this->service->apiResponse(200,$data,'Liste des catégories');

    public function index(){
        try{
            $posts = Post::all();
            $data = [];
            foreach($posts as $post){
                $data[] = new PostResource($post);
            }
            if(count($data) == 0){
                return $this->service->apiResponse(404,$data,"Aucune publications");
            }
            return $this->service->apiResponse(200,$data,"Liste des publications");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }

    public function store(Request $request){
        try{
            $request->validate([
                'content' =>'required',
                'categorie_id' =>'required',
            ]);
            $this->post->content = ($request->content);
            $this->post->categorie_id =($request->categorie_id);
            $this->post->save();
            return $this->service->apiResponse(200,new PostResource($this->post),"Post stocké avec succès");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }

    public function show($id){
        try{
            $post = Post::find($id);
            if(!$post){
                return $this->service->apiResponse(404,[],"Catégorie non trouvé");
            }
            return $this->service->apiResponse(200,new PostResource($this->post),"Détail d'un Post");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }


    public function update(Request $request, $id){
        try{
            $request->validate([
                'content' =>'required',
            ]);
            $post = Post::find($id);
            if(!$post){
                return $this->service->apiResponse(404,[],"Catégorie non trouvé");
            }
            $post->content = $this->post->setName($request->content);
            $post->save();
            return $this->service->apiResponse(200,new PostResource($this->post),"Post modifié avec succès");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }

    public function delete($id){
        try{
            $post = Post::find($id);
            if(!$post){
                return $this->service->apiResponse(404,[],"Post non trouvé");
            }
            return $this->service->apiResponse(200,[],"Post supprimé avec succès");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }

}
