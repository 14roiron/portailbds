<?php

namespace BDS\CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Baikal\ModelBundle\Entity\Calendar;

/**
 * Calendrier
 *
 * @ORM\Table(name="bds_calendrier")
 * @ORM\Entity(repositoryClass="BDS\CalendrierBundle\Entity\CalendrierRepository")
 */
class Calendrier extends Calendar
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

