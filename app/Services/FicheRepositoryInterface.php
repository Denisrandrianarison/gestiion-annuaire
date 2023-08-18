<?php
namespace App\Services;

interface FicheRepositoryInterface
{
    public function fetchFiche();
    public function creatFiche($dto);
    public function updateFiche($dto);
    public function deleteFiche($id);
}
