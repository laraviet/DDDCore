<?php

namespace Laraviet\DDDCore\Domain\Services;

interface ServiceInterface
{
    public function getById($id);
    public function getAll();
    public function paginate($quantity = null);
    public function persist($request, $id = null);
    public function destroy($id);
}