<?php
namespace App\Entity ;
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
}