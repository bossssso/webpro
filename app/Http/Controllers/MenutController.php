<?php
namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\menut;
use App\Models\maindish;
use Psr\Http\Message\ServerRequestInterface;

class MenutController extends SearchableController
{
    private $title = 'menut';

    public function __construct() {
        $this->middleware('auth');
    }

    public function getQuery() 
    {
        return menut::orderBy('code');
    }

    public function list(ServerRequestInterface $request)
    {
        $data = $this->prepareSearch($request->getQueryParams());
        $menuts = $this->search($data)->withCount('maindishes');
        session()->put('bookmark.menut-detail', $request->getUri());

        return view('menut.list',[
            'menuts' => $menuts->paginate(7),
            'data'  => $data,
        ]);
    }

    public function detail($code) 
    {
        $menut = menut::where('code',$code)->firstOrFail();

        return view('menut.detail',[
            'menut' => $menut,
        ]);
    }

    public function createForm() {
        $this->authorize('create', Menut::class);
        return view('menut.create');
    }

    
    public function create(ServerRequestInterface $request) 
    {
        $this->authorize('create', Menut::class);
    try {
        $data = $request->getParsedBody();
        $menut = menut::create($data);

        return redirect()->route('menut-list')
            ->with('status',"menut {$menut->code} was created.");
    } catch(QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
      }
    }
        
    

    public function showmaindish(
        ServerRequestInterface $request,
        MaindishController $MaindishController,
        $menutCode
        ) {
        $menut = $this->find($menutCode);
        $data = $MaindishController->prepareSearch($request->getQueryParams());
        $maindishes = $MaindishController->filterBySearch($menut->maindishes(),$data);
        session()->put('bookmark.menut-detail', $request->getUri());

        // return $maindishes->get();
        return view('menut.detail-maindish', [
        'title' => "menut {$menut->code} : maindish",
        'menut' => $menut,
        'maindishes' => $maindishes->paginate(10),
        'data' => $data,
        ]);
        
        }

    public function addmaindishForm(
        ServerRequestInterface $request,
        MaindishController $MaindishController,
        $menutCode
    ) {
        
        $menut = $this->find($menutCode);
        $query = maindish::orderBy('code')
        ->whereDoesntHave('menut',function($innerQuery) use ($menut) {
            return $innerQuery->where('code',$menut->code);
        });
        $data = $MaindishController->prepareSearch($request->getQueryParams());
        $query = $MaindishController->filterBySearch($query, $data);
            
        return view('menut.add-maindish-form', [
            'title' => " menut {$menut->code} : Add maindish",
            'data' => $data,
            'menut' => $menut,
            'maindishes' => $query->paginate(10),
        ]);
        }

    public function addmaindish(
        ServerRequestInterface $request,
        MaindishController $MaindishController,
        $menutCode
    ) {
        
    try {
        $menut = $this->find($menutCode);
        $data = $request->getParsedBody();
        $maindish = $MaindishController->find($data['maindish']);
        $menut->maindishes()->save($maindish);
        
        return redirect()->back()
        ->with('status',"maindish {$maindish->code} was added to menut {$menut->code}.");
    } catch(QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
    }
        
    
    public function updateForm($code) 
    {
        
        $menut = menut::where('code',$code)->first();

        return view('menut.update',[
            'menut' => $menut,
        ]);
    }

    public function update(ServerRequestInterface $request, $code)
    {
        
    try {
        $data = $request->getParsedBody();
        $menut = menut::where('code',$code)->first();
        $menut->update($data);

        return redirect()->route('menut-detail',['code' => $menut['code']])
            ->with('status',"menut {$menut->code} was updated.");
        } catch(QueryException $excp) {
            return redirect()->back()->withInput()->withErrors([
                'error' => $excp->errorInfo[2],
            ]);
        }
    }
        


    public function delete($code)
    {   
        $menut = menut::where('code',$code)->first();
        
    try {
        $menut->delete();

        return redirect(session()->get('bookmark.menut-detail', route('menut-list')))
        ->with('status', "menut {$menut->code} was deleted.");
    } catch(QueryException $excp) {
        return redirect()->back()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
}
        
    

    public function find($code) {
        return menut::where('code',$code)->first();
    }

    public function removemaindish($menutCode, $maindishCode) {
        $menut = $this->find($menutCode);
        $maindish = $menut->maindishes()->where('code', $maindishCode)->firstOrFail();
        $menut->maindishes()->detach($maindish);

        return redirect()->back()
        ->with('status',"maindish {$maindish->code} was removed to menut {$menut->code}.");
        
    }
}
