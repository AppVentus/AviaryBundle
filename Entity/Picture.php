<?php

namespace Appventus\AviaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Appventus\AviaryBundle\Entity\PictureRepository")
 */
class Picture
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Appventus\AviaryBundle\Entity\Gallery", inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gallery;

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
     * Set gallery
     *
     * @param \Appventus\AviaryBundle\Entity\Gallery $gallery
     * @return Picture
     */
    public function setGallery(\Appventus\AviaryBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Appventus\AviaryBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Picture
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}
