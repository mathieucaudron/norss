<?php

namespace Digeetis\APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AggregateStream
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Digeetis\APIBundle\Entity\AggregateStreamRepository")
 */
class AggregateStream
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
    * @ORM\ManyToOne(targetEntity="Digeetis\APIBundle\Entity\Aggregate", cascade={"persist"})
    * @ORM\JoinColumn(name="aggregate_id", referencedColumnName="id")
    */
    private $aggregate;

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
     * Set aggregate
     *
     * @param string $aggregate
     * @return AggregateStream
     */
    public function setAggregate($aggregate)
    {
        $this->aggregate = $aggregate;

        return $this;
    }

    /**
     * Get aggregate
     *
     * @return string 
     */
    public function getAggregate()
    {
        return $this->aggregate;
    }

    /**
     * Set stream
     *
     * @param string $stream
     * @return AggregateStream
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
     * @return AggregateStream
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
