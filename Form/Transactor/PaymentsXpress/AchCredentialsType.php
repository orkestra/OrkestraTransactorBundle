<?php

namespace Orkestra\Bundle\TransactorBundle\Form\Transactor\PaymentsXpress;

use Symfony\Component\Form\FormBuilder;
use Orkestra\Bundle\TransactorBundle\Form\AbstractCredentialsType;

/**
 * Credentials form type for the Payments Xpress ACH Transactor
 */
class AchCredentialsType extends AbstractCredentialsType
{
    /**
     * Gets the internal type of the associated Transactor
     *
     * @return string
     */
    protected function getTransactorType()
    {
        return 'orkestra.payments_xpress.ach';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('providerId', 'text', array('label' => 'Provider ID'))
            ->add('providerGateId', 'text', array('label' => 'Provider Gate ID'))
            ->add('providerGateKey', 'text', array('label' => 'Provider Gate Key'))
            ->add('merchantId', 'text', array('label' => 'Merchant ID'))
            ->add('merchantGateId', 'text', array('label' => 'Merchant Gate ID'))
            ->add('merchantGateKey', 'text', array('label' => 'Merchant Gate Key'));
    }
}
