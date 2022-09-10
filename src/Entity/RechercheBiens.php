<?php
namespace App\Entity ;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert ;

class RechercheBiens {
    /**

     * @var int|null
     * 
     */
    private $prixMax ;
    /**

     * @var int|null
     * @Assert\Range(min=10,max=400)
     */
    private $surfaceMin ;
    /**
     * @var ArrayCollection
     */
    private $options ;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * Get the value of prixMax
     * @return  int|null
     */ 
    public function getPrixMax()
    {
        return $this->prixMax;
    }

    /**
     * Set the value of prixMax
     *
     * @param  int|null  $prixMax
     *
     * @return  self
     */ 
    public function setPrixMax(int $prixMax)
    {
        $this->prixMax = $prixMax;

        return $this;
    }

    /**
     * Get the value of surfaceMin
     *
     * @return  int|null
     */ 
    public function getSurfaceMin()
    {
        return $this->surfaceMin;
    }

    /**
     * Set the value of surfaceMin
     *
     * @param  int|null  $surfaceMin
     *
     * @return  self
     */ 
    public function setSurfaceMin(int $surfaceMin)
    {
        $this->surfaceMin = $surfaceMin;

        return $this;
    }
    

    /**
     * Get the value of options
     *
     * @return  ArrayCollection
     */ 
    public function getOptions():ArrayCollection
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @param  ArrayCollection  $options
     *
     * @return  self
     */ 
    public function setOptions(ArrayCollection $options)
    {
        $this->options = $options;

        return $this;
    }
}