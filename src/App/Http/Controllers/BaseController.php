<?php

namespace Laraviet\DDDCore\App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $service;
    protected $package;
    protected $root;

    public function index()
    {
        $collection = $this->service->paginate();
        return view("{$this->package}::{$this->root}.index", compact("collection"));
    }

    public function create()
    {
        return view("{$this->package}::{$this->root}.create");
    }

    public function store(Request $request)
    {
        $this->service->persist();
        return redirect()->route("{$this->root}.index");
    }

    public function show($id)
    {
        $model = $this->service->getById($id);
        return view("{$this->package}::{$this->root}.show", compact($model));
    }

    public function edit($id)
    {
        $model = $this->service->getById($id);
        return view("{$this->package}::{$this->root}.edit", compact($model));
    }

    public function update($id, Request $request)
    {
        $this->service->persist($id);
        return redirect()->route("{$this->root}.index");
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route("{$this->root}.index");
    }
}
