<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use App\Services\Utility;
use Exception;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    protected $categorie;
    protected $service;
    public function __construct(Categorie $categorie, Utility $service){
        $this->categorie = $categorie;
        $this->service = $service;
    }
    // return $this->service->apiResponse(200,$data,'Liste des catégories');

    public function index(){
        try{
            $categories = Categorie::all();
            $data = [];
            foreach($categories as $categorie){
                $data[] = new CategorieResource($categorie);
            }
            if(count($data) == 0){
                return $this->service->apiResponse(404,$data,"Aucune catégories");
            }
            return $this->service->apiResponse(200,$data,"Liste des catégories");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }

    public function store(Request $request){
        try{
            $request->validate([
                'name' =>'required',  // Cette validation est cruciale pour s'assurer qu'une valeur est fournie
            ]);
           
            $this->categorie->name = $request->name;
            $this->categorie->save();
            return $this->service->apiResponse(200,new CategorieResource($this->categorie),"Categorie stockée avec succès");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }
    

    public function show($id){
        try{
            $categorie = Categorie::find($id);
            if(!$categorie){
                return $this->service->apiResponse(404,[],"Catégorie non trouvé");
            } 

            return $this->service->apiResponse(200,new CategorieResource($categorie),"Détail d'une catégorie");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }


    public function update(Request $request, $id){
        try{
            $request->validate([
                'name' =>'required',
            ]);
            $categorie = Categorie::find($id);
            if(!$categorie){
                return $this->service->apiResponse(404,[],"Catégorie non trouvé");
            }
            $categorie->name = $this->categorie->setName($request->name);
            $categorie->save();
            return $this->service->apiResponse(200,new CategorieResource($this->categorie),"Categorie modifié avec succès");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }

    public function delete($id){
        try{
            $categorie = Categorie::find($id);
            if(!$categorie){
                return $this->service->apiResponse(404,[],"Catégorie non trouvé");
            }
            return $this->service->apiResponse(200,[],"Categorie supprimé avec succès");
        }catch(Exception $e){
            return $this->service->apiResponse(500,[],$e->getMessage());
        }
    }
}
