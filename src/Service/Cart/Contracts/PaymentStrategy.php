<?php


namespace App\Service\Cart\Contracts;


interface PaymentStrategy
{
    //public function applyPromos();

    public function calculateSubTotals();

    public function applyDiscounts();

    public function calculateGrandTotal();
}
