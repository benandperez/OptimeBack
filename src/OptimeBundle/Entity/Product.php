<?php

namespace OptimeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10, unique = true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "4",
     *      max = "10",
     *      minMessage = "Codigo debe tener minimo 4 caracteres",
     *      maxMessage = "Codigo debe tener minimo 10 caracteres"
     * )
     */
    protected $code;

    /**
     * @ORM\Column(type="string", unique = true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "4",
     *      minMessage = "Nombre debe tener minimo 4 caracteres",
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $description; 

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $make;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;


    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     */
    protected $price;

      

    

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set make.
     *
     * @param string $make
     *
     * @return Product
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make.
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set category.
     *
     * @param \OptimeBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\OptimeBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \OptimeBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
