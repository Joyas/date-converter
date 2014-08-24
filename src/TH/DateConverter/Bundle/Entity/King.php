<?php

namespace TH\DateConverter\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * King
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TH\DateConverter\Bundle\Entity\KingRepository")
 */
class King
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDateReign", type="datetime")
     */
    private $startDateReign;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDateReign", type="datetime")
     */
    private $endDateReign;


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
     * Set name
     *
     * @param string $name
     * @return King
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set startDateReign
     *
     * @param \DateTime $startDateReign
     * @return King
     */
    public function setStartDateReign($startDateReign)
    {
        $this->startDateReign = $startDateReign;

        return $this;
    }

    /**
     * Get startDateReign
     *
     * @return \DateTime 
     */
    public function getStartDateReign()
    {
        return $this->startDateReign;
    }

    /**
     * Set endDateReign
     *
     * @param \DateTime $endDateReign
     * @return King
     */
    public function setEndDateReign($endDateReign)
    {
        $this->endDateReign = $endDateReign;

        return $this;
    }

    /**
     * Get endDateReign
     *
     * @return \DateTime 
     */
    public function getEndDateReign()
    {
        return $this->endDateReign;
    }
}
