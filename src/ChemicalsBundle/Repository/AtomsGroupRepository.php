<?php

namespace ChemicalsBundle\Repository;

use ChemicalsBundle\Repository\PaginatorRepository;

/**
 * AtomsGroupRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AtomsGroupRepository extends PaginatorRepository
{
    /**
     * @TODO : 
     * select * from chemicals_atom a where a.id not in 
     * (select atom_id from chemicals_bound_atoms) 
     * and a.id not in (select main_atom_id from chemicals_atoms_group);
     */
}
