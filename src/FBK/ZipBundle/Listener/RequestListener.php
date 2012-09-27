<?php
namespace FBK\ZipBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;


class RequestListener 
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $event->getRequest()->setFormat('zip', 'application/zip');
    }    
}
