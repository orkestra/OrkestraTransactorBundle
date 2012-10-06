<?php

namespace Orkestra\Bundle\TransactorBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Orkestra\Transactor\Entity\Account\CardAccount;
use Orkestra\Transactor\Entity\Account\BankAccount;
use Orkestra\Transactor\Entity\AbstractAccount;

/**
 * Adds useful functionality to Twig
 *
 * @author Tyler Sommer <sommertm@gmail.com>
 */
class TransactorExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'account_type' => new \Twig_Function_Method($this, 'getAccountType')
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'orkestra_transactor_extension';
    }

    /**
     * Gets a string representation of an account
     *
     * @param \Orkestra\Transactor\Entity\AbstractAccount $account
     *
     * @return string
     */
    public function getAccountType(AbstractAccount $account)
    {
        if ($account instanceof BankAccount) {
            return 'Bank Account';
        } elseif ($account instanceof CardAccount) {
            return 'Credit Card';
        } else {
            return 'Other';
        }
    }
}
