<?php
namespace Album\Controller;
 
use Album\Model\Album;

class AlbumController extends BaseController 
{
    public function __construct() 
    {
        $this->model = new Album();
        $this->routeIndex = 'album';
    }
}