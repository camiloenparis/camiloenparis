<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="fortune_cookie")
 */
class FortuneCookie {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="fortuneCookies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


    /**
     * @ORM\Column(name="fortune", type="string", length=255)
     */
    private $fortune;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getFortune()
    {
        return $this->fortune;
    }

    /**
     * @param mixed $fortune
     */
    public function setFortune($fortune)
    {
        $this->fortune = $fortune;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


} 