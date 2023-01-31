<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductsFormRequest;

class ProductsController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get products da DB
        $products = Product::with('user')->get();
        
        //titulo na Aba da página
        $title_page = 'Produtos - Listagem';
        //titulo da página
        $title = 'Produtos';      
        //titulo na Aba da página
        $active = 'products';
        //titulo da página
        $activeList = 'Listagem';
        
        return view('product.index', compact('title', 'title_page', 'active', 'activeList', 'products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myProducts()
    {

        //get products da DB
        if(auth()->user() && !auth()->user()->admin){
            $products = Product::with('user')->where('user_id', auth()->user()->id)->get();
        } else {
            return redirect()->route('products.index')->withErrors(['errors' => 'Usuario inválido']);
        }
        
        //titulo na Aba da página
        $title_page = 'Meus Produtos - Listagem';
        //titulo da página
        $title = 'Produtos';      
        //titulo na Aba da página
        $active = 'products';
        //titulo da página
        $activeList = 'Meus Produtos';
        
        return view('product.index', compact('title', 'title_page', 'active', 'activeList', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //titulo na Aba da página
        $title_page = 'Produtos - Cadastro';
        //titulo da página
        $title = 'Produtos';      
        //titulo na Aba da página
        $active = 'products';
        //titulo da página
        $activeList = 'Cadastro';
        
        return view('product.form', compact('title', 'title_page', 'active', 'activeList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsFormRequest $request)
    {
        //
        $dataForm = $request->all();

        if(auth()->user() && !auth()->user()->admin){
            $dataForm['user_id'] = auth()->user()->id;
        }

        $insert = $this->product->create($dataForm);

        if ($insert) {
            return redirect()->route('products.index')->with(['status' => 'Sucesso ao criar product']);
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
        $product = Product::with('user')->find($id);

        //titulo na Aba da página
        $title_page = 'Produto: '.$product->name;
        //titulo da página
        $title = 'Produtos';      
        //titulo na Aba da página
        $active = 'products';
        //titulo da página
        $activeList = 'Produto: '.$product->name;
        
        return view('product.show', compact('title', 'title_page', 'active', 'activeList', 'product'));
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
        $product = $this->product->find($id);

        //validar id do usuario com o user do produto
        if (!auth()->user()->admin && $product->user_id != auth()->user()->id) {
            return redirect()->back()->withErrors(['errors' => 'Este produto não pode ser editado pelo seu perfil! Contate o Administrador.']);
        }

        //titulo na Aba da página
        $title_page = 'Produtos - Editar';
        //titulo da página
        $title = 'Produtos';      
        //titulo na Aba da página
        $active = 'products';
        //titulo da página
        $activeList = 'Editar: '.$product->name; 
        
        return view('product.form', compact('title', 'title_page', 'active', 'activeList', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsFormRequest $request, $id)
    {
        //
        $dataForm = $request->all();
        $productUp = $this->product->find($id);
        $dataForm['user_id'] = $productUp->user_id;
        $update = $productUp->update($dataForm);

        if ($update) {
            return redirect()->route('products.index')->with(['status' => 'Sucesso ao atualizar usuário']);
        } else {
            return redirect()->route('products.edit', $id)->withErrors(['errors' => 'Falha ao editar']);
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
        $productDel = $this->product->find($id);
        $delete = $productDel->delete();

        if ($delete) {
            return redirect()->route('products.index')->with(['status' => 'Sucesso ao excluir usuário']);
        } else {
            return redirect()->route('products.show', $id)->withErrors(['errors' => 'Falha ao deletar']);
        }
    }
}
