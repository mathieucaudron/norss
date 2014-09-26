<?php

namespace Digeetis\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleStream
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Digeetis\APIBundle\Entity\ArticleStreamRepository")
 */
class ArticleStream
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
    * @ORM\ManyToOne(targetEntity="Digeetis\APIBundle\Entity\Article", cascade={"persist"})
    * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
    */
    private $article;

    /**
    * @ORM\ManyToOne(targetEntity="Digeetis\APIBundle\Entity\Stream", cascade={"persist"})
    * @ORM\JoinColumn(name="stream_id", referencedColumnName="id")
    */
    private $stream;

    /**
     * @var string
     *
     * @ORM\Column(name="date_update", type="string", length=255)
     */
    private $dateUpdate;


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
     * Set article
     *
     * @param string $article
     * @return ArticleStream
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return string 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set stream
     *
     * @param string $stream
     * @return ArticleStream
     */
    public function setStream($stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get stream
     *
     * @return string 
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set dateUpdate
     *
     * @param string $dateUpdate
     * @return ArticleStream
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
}
