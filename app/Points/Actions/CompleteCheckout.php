<?php

namespace App\Points\Actions;

use Miracuthbert\Royalty\Actions\ActionAbstract;

class CompleteCheckout extends ActionAbstract
{
    /**
     * Set the action key.
     *
     * @return mixed
     */
    public function key()
    {
        return 'complete-checkout';
    }
}
