<?php
namespace Album\Controller;
 
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\Album;
use Album\Form\AlbumForm;
use Doctrine\ORM\EntityManager;

class AlbumController extends BaseController 
{
    public function __construct() 
    {
        $this->model = new Album();
        $this->routeIndex = 'album';
    }
    // /**
    // * @var DoctrineORMEntityManager
    // */
    // protected $em;

    // public function getEntityManager()
    // {
    //     if (null === $this->em) {
    //         $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    //     }
    //     return $this->em;
    // }

    // public function indexAction()
    // {
    //     return new ViewModel(array(
    //         'albums' => $this->getEntityManager()->getRepository('Album\Model\Album')->findAll(),
    //     ));
    // }

    // public function addAction()
    // {
    //     $form = new AlbumForm();
    //     $form->get('submit')->setValue('Criar');
 
    //     $request = $this->getRequest();
    //     if ($request->isPost()) {
    //         $album = new Album();
    //         $form->setInputFilter($album->getInputFilter());
    //         $form->setData($request->getPost());
 
    //         if ($form->isValid()) {
    //             $album->exchangeArray($form->getData());
    //             $this->getEntityManager()->persist($album);
    //             $this->getEntityManager()->flush();
 
    //             // Redirect to list of albums
    //             return $this->redirect()->toRoute('album');
    //         }
    //     }
    //     return array('form' => $form);
    // }

    // public function editAction()
    // {
    //     $id = (int) $this->params()->fromRoute('id', 0);
    //     if (!$id) {
    //         return $this->redirect()->toRoute('album', array(
    //             'action' => 'add'
    //         ));
    //     }
 
    //     $album = $this->getEntityManager()->find('Album\Model\Album', $id);
    //     if (!$album) {
    //         return $this->redirect()->toRoute('album', array(
    //             'action' => 'index'
    //         ));
    //     }
 
    //     $form  = new AlbumForm();
    //     $form->bind($album);
    //     $form->get('submit')->setAttribute('value', 'Editar');
 
    //     $request = $this->getRequest();
    //     if ($request->isPost()) {
    //         $form->setInputFilter($album->getInputFilter());
    //         $form->setData($request->getPost());
 
    //         if ($form->isValid()) {
    //             $this->getEntityManager()->flush();
 
    //             // Redirect to list of albums
    //             return $this->redirect()->toRoute('album');
    //         }
    //     }
 
    //     return array(
    //         'id' => $id,
    //         'form' => $form,
    //     );
    // }

    // public function deleteAction()
    // {
    //     $id = (int) $this->params()->fromRoute('id', 0);
    //     if (!$id) {
    //         return $this->redirect()->toRoute('album');
    //     }
 
    //     $request = $this->getRequest();
    //     if ($request->isPost()) {
    //         $del = $request->getPost('del', 'Não');
 
    //         if ($del == 'Sim') {
    //             $id = (int) $request->getPost('id');
    //             $album = $this->getEntityManager()->find('Album\Model\Album', $id);
    //             if ($album) {
    //                 $this->getEntityManager()->remove($album);
    //                 $this->getEntityManager()->flush();
    //             }
    //         }
 
    //         // Redirect to list of albums
    //         return $this->redirect()->toRoute('album');
    //     }
 
    //     return array(
    //         'id'    => $id,
    //         'album' => $this->getEntityManager()->find('Album\Model\Album', $id)
    //     );
    // }
}