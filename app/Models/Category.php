<?php
namespace App\Models;

use Database\connector;

class Category extends connector
{
    protected $table = 'category';

    /**
     * Creat new Category instance.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Recuperer la liste des categories
     *
     * @return Array
     */
    public function getAllCategory()
    {
        $query = "SELECT * FROM category";
        $result = $this->getQueryBuilder($query, []);

        return $result;
    }

    /**
     * Ajouter categorie
     * @return Array
     */
    public function addCategory($values)
    {
        $query = "INSERT INTO category(libelle,sub_category,created_at,updated_at) 
                        VALUES($values)";

        $this->setQueryBuilder($query, []);
        return ['status' => 'Insertion avec succès'];
    }

    /**
     * Modifier categorie
     * @return Array
     */
    public function updateCategory($client)
    {
        $query = "UPDATE category SET libelle='" . $client['libelle'] . "',
                                          sub_category='" . $client['subCategory'] . "',
                                          updated_at=now()
                                    WHERE Id=" . $client['idCategory'] . "";

        $this->setQueryBuilder($query, []);
        return ['status' => 'Modification avec succès'];
    }

    /**
     * Suprimer categorie
     * @return Array
     */
    public function deleteCategory($categoryId)
    {
        $query = "DELETE FROM category WHERE Id=$categoryId";

        $this->setQueryBuilder($query, []);
        return ['status' => 'Suppression avec succès'];
    }
}
