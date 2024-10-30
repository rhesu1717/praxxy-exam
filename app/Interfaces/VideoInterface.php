<?php

namespace App\Interfaces;

interface  VideoInterface{
    public function index($request);

    public function store($request);

    public function destroy($request);
}