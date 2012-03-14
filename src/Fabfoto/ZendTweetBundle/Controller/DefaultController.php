<?php

namespace Fabfoto\ZendTweetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
class DefaultController extends Controller
{

    public function LastTweetsAction($userName)
    {
        $twitter = new \Zend\Service\Twitter('FabbookFr');
        $tweets = $twitter->status->publicTimeline();
        return $this->render('FabfotoZendTweetBundle:Default:lastTweet.html.twig', 
                array(
                    'tweets' => $tweets
                    ));
        
    }
}
