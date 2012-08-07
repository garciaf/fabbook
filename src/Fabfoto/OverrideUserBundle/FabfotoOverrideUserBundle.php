<?php

namespace Fabfoto\OverrideUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FabfotoOverrideUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
