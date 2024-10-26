<?php

namespace App\Interfaces;

interface ProductInterface {
    public function list($request);

    public function delete($id);
}
