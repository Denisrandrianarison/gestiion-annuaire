<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Facades\JsonResponse;

class CategoryController
{
    protected $categoryModel;
    protected $request;

    public function __construct()
    {
        $this->categoryModel = new Category();
        $this->request = $_REQUEST;
    }

    /**
     * Recuperer la liste des categories.
     * @return JsonResponse
     */
    public function fetchCategory()
    {
        try {
            $result = $this->categoryModel->getAllCategory();
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

    /**
     * Creé categorie.
     * @return JsonResponse
     */
    public function createCategory()
    {
        try {
            $values = $this->getQueryValue($this->request);
            $result = $this->categoryModel->addCategory($values);
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

     /**
     * Modifier categorie.
     * @return JsonResponse
     */
    public function updateCategory()
    {
        try {
            $result = $this->categoryModel->updateCategory($this->request);
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

    /**
     * Suprimer categorie.
     * @return JsonResponse
     */
    public function deleteCategory($id)
    {
        try {
            $result = $this->categoryModel->deleteCategory($id);
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

    /**
     * @return string
    */
    private function getQueryValue($data)
    {
        return  '"' . $data['libelle'] . '", 
                "' .  $data['subCategory'] . '",
                now(),
                now()';
    }
}
