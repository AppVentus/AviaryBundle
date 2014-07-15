<?php

namespace Appventus\AviaryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Gallery
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Appventus\AviaryBundle\Entity\GalleryRepository")
 */
class Gallery
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
     * @ORM\OneToMany(targetEntity="Appventus\AviaryBundle\Entity\Picture", mappedBy="gallery", cascade={"persist"}, orphanRemoval=true)
     */
    protected $pictures;
    

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }


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
     * Add pictures
     *
     * @param \Appventus\AviaryBundle\Entity\Picture $pictures
     * @return Gallery
     */
    public function addPicture(\Appventus\AviaryBundle\Entity\Picture $picture)
    {
        $picture->setGallery($this);
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove pictures
     *
     * @param \Appventus\AviaryBundle\Entity\Picture $pictures
     */
    public function removePicture(\Appventus\AviaryBundle\Entity\Picture $picture)
    {
        $this->pictures->removeElement($picture);
        $picture->setGallery(null);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPictures()
    {
        return $this->pictures;
    }
    /**
     * Set pictures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;
    }
}
