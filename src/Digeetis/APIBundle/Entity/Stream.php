<?php

namespace Digeetis\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stream
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Digeetis\APIBundle\Entity\StreamRepository")
 */
class Stream
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
     * @var boolean
     *
     * @ORM\Column(name="is_main", type="boolean")
     */
    private $isMain;
    
    /**
     * @ORM\OneToMany(targetEntity="Digeetis\APIBundle\Entity\ArticleStream", mappedBy="stream") 
     */
    private $articles;

    /**
    * @ORM\ManyToOne(targetEntity="Digeetis\APIBundle\Entity\Stream")
    * @ORM\JoinColumn(name="parent_category", referencedColumnName="id")
    */
    private $parentCategory;


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
     * @return Stream
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
     * Set isMain
     *
     * @param boolean $isMain
     * @return Stream
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return boolean 
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * Set mainCategory
     *
     * @param string $mainCategory
     * @return Stream
     */
    public function setMainCategory($mainCategory)
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }

    /**
     * Get mainCategory
     *
     * @return string 
     */
    public function getMainCategory()
    {
        return $this->mainCategory;
    }

    /**
     * Set parentCategory
     *
     * @param \Digeetis\APIBundle\Entity\Stream $parentCategory
     * @return Stream
     */
    public function setParentCategory(\Digeetis\APIBundle\Entity\Stream $parentCategory = null)
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

    /**
     * Get parentCategory
     *
     * @return \Digeetis\APIBundle\Entity\Stream 
     */
    public function getParentCategory()
    {
        return $this->parentCategory;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param \Digeetis\APIBundle\Entity\ArticleStream $articles
     * @return Stream
     */
    public function addArticle(\Digeetis\APIBundle\Entity\ArticleStream $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Digeetis\APIBundle\Entity\ArticleStream $articles
     */
    public function removeArticle(\Digeetis\APIBundle\Entity\ArticleStream $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
