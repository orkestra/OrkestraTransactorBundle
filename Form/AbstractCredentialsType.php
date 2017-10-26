<?php

/*
 * This file is part of OrkestraTransactorBundle.
 *
 * Copyright (c) Orkestra Community
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Orkestra\Bundle\TransactorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Orkestra\Transactor\TransactorFactory;
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
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['include_transactor']) {
            $transactors = array();
    
            foreach ($this->_factory->getTransactors() as $transactor) {
                if (false === $options['network'] || $transactor->supportsNetwork($options['network'])) {
                    $transactors[$transactor->getName()] = $transactor->getType();
                }
            }

            $builder->add('transactor', ChoiceType::class, array(
                'choices' => $transactors,
                'placeholder' => $options['empty_value'],
                'label' => $options['label'],
                'disabled' => $options['disable_transactor']
            ));
        }
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'network' => false,
            'data_class' => 'Orkestra\Transactor\Entity\Credentials',
            'placeholder' => '',
            'label' => 'Transactor',
            'include_transactor' => true,
            'disable_transactor' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orkestra_transactor_credentials';
    }
}
