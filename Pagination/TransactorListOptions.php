<?php

namespace Orkestra\TransactorBundle\Pagination;

use Orkestra\PaginationBundle\Pagination\PaginationOptions,
    Orkestra\PaginationBundle\Pagination\Columns\PropertyColumn,
    Orkestra\PaginationBundle\Pagination\Columns\BooleanColumn,
    Orkestra\PaginationBundle\Pagination\Filters\Doctrine,
    Orkestra\PaginationBundle\Pagination\Adapters\DoctrineAdapter,
    Doctrine\ORM\EntityManager;

class TransactorListOptions extends PaginationOptions
{
    public function __construct(EntityManager $em)
    {
        $query = $em->createQuery('SELECT t FROM Orkestra\Transactor\Entity\TransactorBase t');
        $this->setAdapter(new DoctrineAdapter($query))
             
             ->addColumn(new PropertyColumn('id', 'ID'))
             ->addColumn(new PropertyColumn('name', 'Name', array(
                                'route' => 'transactor_show', 
                                'routeParams' => array(
                                    'id' => 'id'
                                ))))
             ->addColumn(new PropertyColumn('description', 'Description'))
             ->addColumn(new BooleanColumn('active', 'Active'));
    }
}