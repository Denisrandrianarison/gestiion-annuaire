<?php
namespace App\Http\Controllers;

use App\Models\Fiche;
use App\Facades\JsonResponse;

class FicheController
{
    protected $ficheModel;
    protected $request;

    public function __construct()
    {
        $this->ficheModel = new Fiche();
        $this->request = $_REQUEST;
    }

    /**
     * Recuperer la liste des fiches.
     * @return JsonResponse
     */
    public function fetchFiche()
    {
        try {
            $result = $this->ficheModel->getAllFiche();
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

    /**
     * Ajouter fiche.
     * @return JsonResponse
     */
    public function creatFiche()
    {
        try {
            $values = $this->getQueryValue($this->request);
            $result = $this->ficheModel->addFiche($values);
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

     /**
     * Modifier fiche.
     * @return JsonResponse
     */
    public function updateFiche()
    {
        try {
            $result = $this->ficheModel->updateFiche($this->request);
        } catch (\Throwable $th) {
            throw $th;
        }

        return JsonResponse::json($result);
    }

    /**
     * Suprimer fiche.
     * @return JsonResponse
     */
    public function deleteFiche($id)
    {
        try {
            $result = $this->ficheModel->deleteFiche($id);
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
                "' .  $data['description'] . '",
                "' . $data['category'] . '",
                now(),
                now()';
    }
}
