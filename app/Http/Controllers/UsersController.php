<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UsersFormRequest;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth');
        $this->middleware('admin', ['except' => 'editMyProfile', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get users da DB
        $users = $this->user->all();
        
        //titulo na Aba da página
        $title_page = 'Usuários - Listagem';
        //titulo da página
        $title = 'Usuários';      
        //titulo na Aba da página
        $active = 'users';
        //titulo da página
        $activeList = 'Listagem';
        
        return view('user.index', compact('title', 'title_page', 'active', 'activeList', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //titulo na Aba da página
        $title_page = 'Usuários - Cadastro';
        //titulo da página
        $title = 'Usuários';      
        //titulo na Aba da página
        $active = 'users';
        //titulo da página
        $activeList = 'Cadastro';
        
        return view('user.form', compact('title', 'title_page', 'active', 'activeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersFormRequest $request)
    {
        //metodo de insersão no bd na tabela users
        $dataForm = $request->all();

        //sql run!!!
        $insert = $this->user->create($dataForm);

        if ($insert) {
            return redirect()->route('users.index')->with(['status' => 'Sucesso ao criar user']);
        } else {
            return redirect()->back()->withErrors(['errors' => 'Falha ao criar']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = $this->user->find($id);

        //titulo na Aba da página
        $title_page = 'Perfil: '.$user->name;
        //titulo da página
        $title = 'Usuários';      
        //titulo na Aba da página
        $active = 'users';
        //titulo da página
        $activeList = 'Perfil: '.$user->name;
        
        return view('user.show', compact('title', 'title_page', 'active', 'activeList', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = $this->user->find($id);

        //titulo na Aba da página
        $title_page = 'Usuários - Editar';
        //titulo da página
        $title = 'Usuários';      
        //titulo na Aba da página
        $active = 'users';
        //titulo da página
        $activeList = 'Editar: '.$user->name; 
        
        return view('user.form', compact('title', 'title_page', 'active', 'activeList', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMyProfile()
    {
        //
        $user = $this->user->find(auth()->user()->id);

        //titulo na Aba da página
        $title_page = 'Editar - Meu Perfil';
        //titulo da página
        $title = 'Usuários';      
        //titulo na Aba da página
        $active = 'users';
        //titulo da página
        $activeList = 'Editar: '.$user->name; 
        
        return view('user.form', compact('title', 'title_page', 'active', 'activeList', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();

        $userUp = $this->user->find($id);

        if ($dataForm['password'] == null) {
            $dataForm['password'] = $userUp->password;
        }
        
        $update = $userUp->update($dataForm);

        if ($update) {
            return redirect()->route('users.index')->with(['status' => 'Sucesso ao atualizar usuário']);
        } else {
            return redirect()->route('users.edit', $id)->withErrors(['errors' => 'Falha ao editar']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $userDel = $this->user->find($id);
        $delete = $userDel->delete();
        //$destroy = $userDel->destroy();

        if ($delete) {
            return redirect()->route('users.index')->with(['status' => 'Sucesso ao excluir usuário']);
        } else {
            return redirect()->route('users.show', $id)->withErrors(['errors' => 'Falha ao deletar']);
        }
    }
}