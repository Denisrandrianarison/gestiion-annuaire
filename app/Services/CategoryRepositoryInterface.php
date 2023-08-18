<?php
namespace App\Services;

interface CategoryRepositoryInterface
{
    public function fetchCategory();
    public function createCategory($dto);
    public function updateCategory($dto);
    public function deleteCategory($id);
}
