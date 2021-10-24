<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchableController extends Controller
{
    public function getQuery()
    {
        return null;
    }

    public function filterByTerm($query, $term)
    {
        if (!empty($term)) {
            $words = preg_split('/\s+/', $term);

            foreach ($words as $word) {
                $query->where(function ($innerQuery) use ($word) {
                    return $innerQuery->where('name', 'LIKE', "%{$word}%")
                        ->orWhere('code', 'LIKE', "%{$word}%");
                });
            }
        }

        return $query;
    }

    public function prepareSearch($data)
    {
        $data['term'] = empty($data['term']) ? '' : $data['term'];

        return $data;
    }

    function filterBySearch($query, $data)
    {
        return $this->filterByTerm($query, $data['term']);
    }

    public function search($data)
    {
        $query = $this->getQuery();
        return $this->filterBySearch($query, $data);

    }

    function find($code){
        return $this->getQuery()->where('code',$code)->firstOrFail();
    }
}