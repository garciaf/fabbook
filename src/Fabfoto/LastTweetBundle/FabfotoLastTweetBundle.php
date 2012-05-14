<?php

namespace Fabfoto\LastTweetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FabfotoLastTweetBundle extends Bundle
{
    public function getParent()
    {
        return 'KnpLastTweetsBundle';
    }
}
