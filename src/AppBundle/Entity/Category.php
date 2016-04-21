<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\Column(name="iconKey", type="integer")
     */
    private $iconKey;


    /**
     * @ORM\OneToMany(targetEntity="FortuneCookie", mappedBy="category")
     */
    private $fortuneCookies;

    /**
     * @return mixed
     */
    public function getFortuneCookies()
    {
        return $this->fortuneCookies;
    }

    /**
     * @param mixed $fortuneCookies
     */
    public function setFortuneCookies($fortuneCookies)
    {
        $this->fortuneCookies = $fortuneCookies;
    }

    /**
     * @return mixed
     */
    public function getIconKey()
    {
        return $this->iconKey;
    }

    /**
     * @param mixed $iconKey
     */
    public function setIconKey($iconKey)
    {
        $this->iconKey = $iconKey;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

} 