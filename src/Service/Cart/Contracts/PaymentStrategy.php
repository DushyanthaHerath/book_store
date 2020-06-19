<?php


namespace App\Service\Cart\Contracts;


/**
 * Interface PaymentStrategy
 * @package App\Service\Cart\Contracts
 *
 * Abstraction of payment strategy
 */
interface PaymentStrategy
{
    //public function applyPromos();

    /**
     * @return mixed
     */
    public function calculateSubTotals();

    /**
     * @return mixed
     */
    public function applyDiscounts();


    /**
     * @return mixed
     */
    public function calculateGrandTotal();
}
