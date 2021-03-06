<?php

namespace ChemicalsBundle\Repository;

use ChemicalsBundle\Repository\PaginatorRepository;

/**
 * MoleculeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MoleculeRepository extends PaginatorRepository
{
    public function loadMolecule($id)
    {
        $molecule = null;
        $result = $this->findById($id);
        if (!empty($result) && isset($result[0])) {
            $molecule = $result[0];
        } 
        return !empty($molecule) ? json_decode($molecule->serialize()) : null;
    }
}
