<?php

namespace Orkestra\Bundle\TransactorBundle\Listing;

use Orkestra\OrkestraBundle\Component\Listing\ListingOptions,
    Orkestra\OrkestraBundle\Component\Listing\Column,
    Orkestra\OrkestraBundle\Component\Listing\Route,
    Orkestra\OrkestraBundle\Component\Listing\Adapter\DoctrineAdapter;

use Doctrine\ORM\EntityManager;

/**
 * Transactor Options
 *
 * Defines the default listing options for Transactors
 */
class TransactorOptions extends ListingOptions
{
    /**
     * Constructor
     *
     * @param Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $adapter = new DoctrineAdapter($em->createQuery('SELECT t FROM Orkestra\Transactor\Entity\TransactorBase t'));

        $this->setAdapter($adapter)
             ->addDisplayColumn(new Column\PropertyColumn('id', 'ID', array('width' => '75px', 'class' => 'center')))
             ->addDisplayColumn(new Column\PropertyColumn('name', 'Name', array('width' => '150px')))
             ->addDisplayColumn(new Column\PropertyColumn('description', 'Description'))
             ->addDisplayColumn(new Column\PropertyColumn('type', 'Type', array('width' => '150px', 'class' => 'center')))
             ->addDisplayColumn(new Column\BooleanColumn('active', 'Active', array('width' => '125px', 'class' => 'center')))
             ->addDisplayColumn(new Column\PropertyColumn('dateModified', 'Date Modified', array('width' => '125px', 'class' => 'center')))
             ->addDisplayColumn(new Column\PropertyColumn('dateCreated', 'Date Created', array('width' => '125px', 'class' => 'center')))
             ->setAddRoute(new Route('admin_transactor_new'))
             ->setEditRoute(new Route('admin_transactor_edit', array('id' => 'id')))
             ->setDefaultAction(ListingOptions::EditDefaultAction);
    }
}
