<?php
namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends SearchableController
{
    private $title = 'User';

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
                            ->orWhere('email','LIKE',"%{$word}%")
                            ->orWhere('role','LIKE',"%{$word}%");
                });
            }
        }

        return $query;
    }

    public function getQuery() 
    {
        return User::orderBy('email');
    }

    public function list(ServerRequestInterface $request)
    {
        $data = $this->prepareSearch($request->getQueryParams());
        $users = $this->search($data);
        session()->put('bookmark.user-detail', $request->getUri());

        return view('user.list',[
            'users' => $users->paginate(3),
            'data'  => $data,
        ]);
    }

    public function detail($email) 
    {
        $user = User::where('email',$email)->firstOrFail();

        return view('user.detail',[
            'user' => $user,
        ]);
    }

    public function createForm() {
        $this->authorize('create', User::class);
        $roles =['USER' , 'ADMIN'];
        return view('user.create',[
            'roles' => $roles,
        ]);
    }

    public function create(ServerRequestInterface $request) 
    {
        $this->authorize('create', User::class);
    try {
        $data = $request->getParsedBody();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user-> role = $data['role'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return redirect()->route('user-list')
        ->with('status',"User {$user->email} was created.");
    } catch(QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
      }
    }
        
    

    public function updateForm($email) 
    {
        $this->authorize('update', User::class);
        $user = User::where('email',$email)->first();

        return view('user.update',[
            'user' => $user,
        ]);
    }

    public function update(ServerRequestInterface $request, $email)
    {
        $this->authorize('update', User::class);
    try {
        $data = $request->getParsedBody();
        $user = User::where('email',$email)->first();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user-> role = $data['role'];
        if(!empty($data['password'])){
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect()->route('user-detail',['email' => $user['email']])
        ->with('status',"User {$user->email} was updated.");
    } catch(QueryException $excp) {
        return redirect()->back()->withInput()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
}
        
    

    public function delete($email)
    {
        $this->authorize('delete', User::class);
    try {
        $user = User::where('email',$email)->first();
        $user->delete();

        return redirect(session()->get('bookmark.user-detail', route('user-list')))
        ->with('status', "User {$user->email} was deleted.");
    } catch(QueryException $excp) {
        return redirect()->back()->withErrors([
            'error' => $excp->errorInfo[2],
        ]);
    }
}
        
    

    public function find($email) {
        return User::where('email',$email)->first();
    }
}
