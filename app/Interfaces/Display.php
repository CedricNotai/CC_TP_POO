<?php
namespace App\Interfaces;

interface Display {
    const INDEX_ROUTE = "index";
    const SHOW_ROUTE = "show";

    public function index();
    public function show(int $id);
}