<?php

namespace Laraviet\DDDCore\App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $service;
    protected $package;

    public function index()
    {
        $books = $this->service->paginate();
        return view("{$this->package}::books.index", compact("books"));
    }

    public function create()
    {
        return view("{$this->package}::books.create");
    }

    public function store(Request $request)
    {
        $this->service->persist();
        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = $this->service->getById($id);
        return view("{$this->package}::books.show", compact("book"));
    }

    public function edit($id)
    {
        $book = $this->service->getById($id);
        return view("{$this->package}::books.edit", compact("book"));
    }

    public function update($id, Request $request)
    {
        $this->service->persist($id);
        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('books.index');
    }
}
