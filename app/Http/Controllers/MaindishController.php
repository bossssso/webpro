<?php

namespace App\Http\Controllers;

use App\Models\Menut;
use App\Models\Maindish;
use Illuminate\Http\Request;
use Psr\Http\Message\ServerRequestInterface;

class MaindishController extends SearchableController
{
    private $title = 'Maindish';

    public function __construct() {
        $this->middleware('auth');
    }

    public function filterByTerm($query, $term)
    {
        if(!empty($term)) {
            $words = preg_split('/\s+/', $term);

            foreach($words as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                            ->where('name','LIKE',"%{$word}%")
                            ->orWhere('code','LIKE',"%{$word}%")
                            ->orWhereHas('category',function($query) use ($word){
                                $query->where('name','LIKE',"%{$word}%");
                            });
                            
                });
            }
        }

        return $query;
    }

    public function getQuery() {
        return Maindish::orderBy('code');
    }

    public function prepareSearch($data)
    {
        $data = parent::prepareSearch($data);
        $data = array_merge([
            'minPrice' => null,
            'maxPrice' => null,
        ], $data);

        return $data;
    }

    public function filterByPrice($query, $minPrice, $maxPrice)
    {
        if($minPrice !=null) {
            $query->where('price', '>=', $minPrice);
        }
        
        if($maxPrice !=null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }

    public function search($data)
    {
        $query = parent::search($data);
        $query = $this->filterByPrice($query, $data['minPrice'], $data['maxPrice']);

        return $query;
    }

    public function list(ServerRequestInterface $request)
    {
        $data = $this->prepareSearch($request->getQueryParams());
        $maindishes = $this->search($data);
         

        return view('maindish.list',[
            'maindishes' => $maindishes->paginate(),
            'data' => $data,
        ]);
    }

    public function detail($code) 
    {
        $maindish = Maindish::where('code',$code)->firstOrFail();

        return view('maindish.detail', [
            'maindish' => $maindish,
        ]);
    }
    public function createForm()
    {
        $this->authorize('create', Maindish::class);

        $menuts = Menut::orderBy('code')->get();
        return view('maindish.create',[
            'menuts' => $menuts,
        ]);
    }

    public function create(ServerRequestInterface $request)
    {
        $this->authorize('create', Maindish::class);

        $data = $request->getParsedBody();

        Maindish::create($data);

        return redirect()->route('maindish-list');
    }

    public function filterBySearch($query, $data) {
        $query = parent::filterBySearch($query, $data);
        $query = $this->filterByPrice($query, $data['minPrice'], $data['maxPrice']);

        return $query;
    }

    public function updateForm($code) 
    {
        $this->authorize('create', Maindish::class);
        $maindish = Maindish::where('code',$code)->first();
        $menuts = Menut::orderBy('code')->get();

        return view('maindish.update',[
            'maindish' => $maindish,
            'menuts' => $menuts,
        ]);
    }

    public function update(ServerRequestInterface $request, $code)
    {
        $this->authorize('create', Maindish::class);
    try {
        $data = $request->getParsedBody();
        $maindish = maindish::where('code',$code)->first();
        $maindish->update($data);

        return redirect()->route('maindish-detail',['code' => $maindish['code']])
            ->with('status',"Maindish {$maindish->code} was updated.");
        } catch(QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }


    public function delete($code) 
    {
        $this->authorize('create', Maindish::class);
        $maindish = maindish::where('code', $code)->first();

        $maindish->delete();

        return redirect()->route('maindish-list');
    }

    public function find($code) {
        return Maindish::where('code',$code)->first();
    }
}