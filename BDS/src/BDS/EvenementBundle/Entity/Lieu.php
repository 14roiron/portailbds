<?php

namespace BDS\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieu
 *
 * @ORM\Table(name="bds_lieu")
 * @ORM\Entity(repositoryClass="BDS\EvenementBundle\Entity\LieuRepository")
 */
class Lieu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numVoie", type="string", length=255)
     */
    private $numVoie;
    
    /**
     * @var string
     *
     * @ORM\Column(name="voie", type="string", length=255)
     */
    private $voie;
    
    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=255)
     */
    private $zipcode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;
    
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255)
     */
    private $region;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=50)
     */
    private $lat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=50)
     */
    private $lng;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fullAdr", type="string", length=255)
     */
    private $fullAdr;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Lieu
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set locality
     *
     * @param string $locality
     *
     * @return Lieu
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Get locality
     *
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Lieu
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set lat
     *
     * @param float $lat
     *
     * @return Lieu
     */
    public function setLat($lat)
    {
    	if(is_string($lat))
    	{
    		$lat = floatval($lat);
    	}
    	
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return float
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     *
     * @return Lieu
     */
    public function setLng($lng)
    {
    	if (is_string($lng))
    	{
    		$lng = floatval($lng);
    	}
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return float
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set numVoie
     *
     * @param string $numVoie
     *
     * @return Lieu
     */
    public function setNumVoie($numVoie)
    {
        $this->numVoie = $numVoie;

        return $this;
    }

    /**
     * Get numVoie
     *
     * @return string
     */
    public function getNumVoie()
    {
        return $this->numVoie;
    }

    /**
     * Set voie
     *
     * @param string $voie
     *
     * @return Lieu
     */
    public function setVoie($voie)
    {
        $this->voie = $voie;

        return $this;
    }

    /**
     * Get voie
     *
     * @return string
     */
    public function getVoie()
    {
        return $this->voie;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return Lieu
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Lieu
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Lieu
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Lieu
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set fullAdr
     *
     * @param string $fullAdr
     *
     * @return Lieu
     */
    public function setFullAdr($fullAdr)
    {
        $this->fullAdr = $fullAdr;

        return $this;
    }

    /**
     * Get fullAdr
     *
     * @return string
     */
    public function getFullAdr()
    {
        return $this->fullAdr;
    }
}
