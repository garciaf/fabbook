<?php

namespace Fabfoto\GalleryBundle\Form\Model;

use Knp\KnoodleBundle\Entity\Survey as Survey;
class PictureAlbum
{
    public $firstName;
    public $lastName;
    public $email;
    public $choices = array();
    
    private $survey;
    
    public function __construct(Survey $survey){
        $this->survey = $survey;
    }
    public function getSurvey(){
        return $this->survey;
    }
}