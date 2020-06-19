<?php


namespace App\Observers;


interface ObserverInterface
{
    /**
     * @return mixed
     */
    public function handle();
}
