<?php
namespace Album\Model;
  
use Doctrine\ORM\Mapping as ORM;
  
/**
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    public function getId() 
    {
        return $this->id;
    }
  
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getEmail() 
    {
        return $this->email;
    }
  
    public function setEmail($email) 
    {
        $this->email = $email;
    }
  
    public function getPassword() 
    {
        return $this->password;
    }
  
    public function setPassword($password) 
    {
        $this->password = $password;
    }
    
     
}