<?php

/*
 * Copyright (c) 2013 Orkestra Community
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace Orkestra\Bundle\TransactorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
        $transactors = array();

        foreach ($this->_factory->getTransactors() as $transactor) {
            if (false === $options['network'] || $transactor->supportsNetwork($options['network'])) {
                $transactors[$transactor->getType()] = $transactor->getName();
            }
        }

        $builder->add('transactor', 'choice', array('choices' => $transactors, 'empty_value' => ''));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'network' => false,
            'data_class' => 'Orkestra\Transactor\Entity\Credentials'
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
