<?php

namespace Digeetis\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Digeetis\APIBundle\Entity\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="date_creation", type="string", length=255)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="date_update", type="string", length=255, nullable=true)
     */
    private $dateUpdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=true)
     */
    private $isDeleted;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnails", type="text")
     */
    private $thumbnails;


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
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set dateCreation
     *
     * @param string $dateCreation
     * @return Article
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return string 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateUpdate
     *
     * @param string $dateUpdate
     * @return Article
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return string 
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     * @return Article
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean 
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set contentCell
     *
     * @param string $contentCell
     * @return Article
     */
    public function setContentCell($contentCell)
    {
        $this->contentCell = $contentCell;

        return $this;
    }

    /**
     * Get contentCell
     *
     * @return string 
     */
    public function getContentCell()
    {
        return $this->contentCell;
    }

    /**
     * Set contentFull
     *
     * @param string $contentFull
     * @return Article
     */
    public function setContentFull($contentFull)
    {
        $this->contentFull = $contentFull;

        return $this;
    }

    /**
     * Get contentFull
     *
     * @return string 
     */
    public function getContentFull()
    {
        return $this->contentFull;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set thumbnails
     *
     * @param string $thumbnails
     * @return Article
     */
    public function setThumbnails($thumbnails)
    {
        $this->thumbnails = $thumbnails;

        return $this;
    }

    /**
     * Get thumbnails
     *
     * @return string 
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }
}
