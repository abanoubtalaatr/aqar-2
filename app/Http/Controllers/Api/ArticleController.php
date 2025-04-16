<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Article;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleResource;

class ArticleController extends Controller
{
    use GeneralTrait;

    public function index(Request $request, $city = null)
    {
        $city = City::find($city);
        if ($city) {
            $articles = $city->articles()->paginate();
            $articles = ArticleResource::collection($articles)->response()->getData();
        } else {
            $articles = Article::query()->paginate();

            $articles = ArticleResource::collection($articles)->response()->getData();
        }

        return $this->returnData('data', $articles);
    }


    public function show(Article $article)
    {
        return $this->returnData('article', new ArticleResource($article));
    }
}
