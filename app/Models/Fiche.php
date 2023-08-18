<?php
namespace App\Models;

use Database\connector;

class Fiche extends connector
{
    protected $table = 'fiche';

    /**
     * Creat new Fiche instance.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Recuperer la liste des fiches
     *
     * @return Array
     */
    public function getAllFiche()
    {
        $query = "SELECT f.id, f.libelle, f.description, cat.id as idCategory, cat.libelle as category, cat.sub_category
                    FROM fiche as f
                    join category as cat on cat.id=f.id_category";

        $result = $this->getQueryBuilder($query, []);

        return $result;
    }

    /**
     * Ajouter fiche
     * @return Array
     */
    public function addFiche($values)
    {
        $query = "INSERT INTO fiche(libelle,description,id_category,created_at,updated_at) 
                        VALUES($values)";

        $this->setQueryBuilder($query, []);
        return ['status' => 'Insertion avec succès'];
    }

    /**
     * Modifier fiche
     * @return Array
     */
    public function updateFiche($client)
    {
        $query = "UPDATE fiche SET libelle='" . $client['libelle'] . "',
                                          description='" . $client['description'] . "',
                                          id_category='" . $client['category'] . "',
                                          updated_at=now()
                                    WHERE Id=" . $client['idFiche'] . "";

        $this->setQueryBuilder($query, []);
        return ['status' => 'Modification avec succès'];
    }

    /**
     * Suprimer fiche
     * @return Array
     */
    public function deleteFiche($ficheId)
    {
        $query = "DELETE FROM fiche WHERE Id=$ficheId";

        $this->setQueryBuilder($query, []);
        return ['status' => 'Suppression avec succès'];
    }
}
