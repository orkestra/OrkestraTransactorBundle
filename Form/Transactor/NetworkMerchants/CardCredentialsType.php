<?php

namespace Orkestra\Bundle\TransactorBundle\Form\Transactor\NetworkMerchants;

use Symfony\Component\Form\FormBuilderInterface;
use Orkestra\Bundle\TransactorBundle\Form\AbstractCredentialsType;

/**
 * Credentials form type for the Network Merchants Card Transactor
 */
class CardCredentialsType extends AbstractCredentialsType
{
    /**
     * Gets the internal type of the associated Transactor
     *
     * @return string
     */
    protected function getTransactorType()
    {
        return 'orkestra.network_merchants.card';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('username', 'text')
            ->add('password', 'text');
    }
}
