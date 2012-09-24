<?php

namespace Orkestra\Bundle\TransactorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Orkestra\Transactor\TransactorFactory;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Base class for any Credentials form type
 */
abstract class AbstractCredentialsType extends AbstractType
{
    /**
     * @var \Orkestra\Transactor\TransactorFactory
     */
    protected $_factory;

    /**
     * Constructor
     *
     * @param \Orkestra\Transactor\TransactorFactory $factory
     */
    public function __construct(TransactorFactory $factory)
    {
        $this->_factory = $factory;
    }

    /**
     * Gets the internal type of the associated Transactor
     *
     * @abstract
     * @return string
     */
    abstract protected function getTransactorType();

    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transactors = array();

        foreach ($this->_factory->getTransactors() as $transactor) {
            $transactors[$transactor->getType()] = $transactor->getName();
        }

        $builder->add('transactor', 'choice', array('choices' => $transactors, 'empty_value' => ''));
    }

    /**
     * @param array $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Orkestra\Transactor\Entity\Credentials'
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orkestra_transactor_credentials';
    }
}
