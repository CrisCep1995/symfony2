<?php

namespace ProductoBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="ProductoBundle\Repository\CategoryRepository")
 */
class Category implements \JsonSerializable
{
    /**
    *@ORM\ManyToMany(targetEntity="Producto", mappedBy="categories")
    *@ORM\JoinTable(name="Product_category")
    */
    private $products=null;
    public function __construct()
    {
        $this->products= new ArrayCollection();
    }
    public function getProducts()
    {
        return $this->products;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
    public function __toString()
    {

        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
                    'id'=>$this->getId(),
                    'name'=>$this->getName(),
        ];
    }
}

