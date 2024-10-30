<?php

namespace App\Interfaces;

interface ProductInterface {
    public function list($request);

    public function delete($id);

    public function store($request);

    public function edit($id);

    public function update($request, $id);
}
