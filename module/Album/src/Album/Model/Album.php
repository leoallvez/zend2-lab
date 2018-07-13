<?php
namespace Album\Model;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface; 

#http://www.jasongrimes.org/2012/01/using-doctrine-2-in-zend-framework-2/

/**
 * A music album.
 *
 * @ORM\Entity
 * @ORM\Table(name="album")
 * @property string $artist
 * @property string $title
 * @property int $id
 */
class Album extends BaseModel
{
    protected $inputFilter;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
  
    /**
     * @ORM\Column(type="string")
     */
    protected $artist;
  
    /**
     * @ORM\Column(type="string")
     */
    protected $title;
  
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function exchangeArray($data = array()) 
    {
        $this->id = $data['id'];
        $this->artist = $data['artist'];
        $this->title = $data['title'];
    }
}