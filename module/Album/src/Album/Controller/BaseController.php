<?php
namespace Album\Controller;

use Album\Form\AlbumForm;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{
    /**
    * @var DoctrineORMEntityManager
    */
    protected $em;
    protected $model;
    protected $routeIndex;

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'results' => $this->getEntityManager()->getRepository(get_class($this->model))->findAll(),
        ));
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Criar');
 
        $request = $this->getRequest();
   
        if ($request->isPost()) {
            //$form->setInputFilter($this->model->getInputFilter());
            //$form->setData($request->getPost());

            //var_dump($request->getPost()); die;
 
            // if ($form->isValid()) {
                $this->model->exchangeArray($form->getData());
                $this->getEntityManager()->persist($this->model);
                $this->getEntityManager()->flush();
                // Redirect to list
                return $this->redirect()->toRoute($this->routeIndex);
            // }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute($this->routeIndex, array(
                'action' => 'add'
            ));
        }
 
        $model = $this->getEntityManager()->find(get_class($this->model), $id);
        if (!$model) {
            return $this->redirect()->toRoute($this->routeIndex, array(
                'action' => 'index'
            ));
        }
 
        $form  = new AlbumForm();
        $form->bind($model);
        $form->get('submit')->setAttribute('value', 'Editar');
 
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($model->getInputFilter());
            $form->setData($request->getPost());
 
            if ($form->isValid()) {
                $this->getEntityManager()->flush();
 
                // Redirect to list of albums
                return $this->redirect()->toRoute($this->routeIndex);
            }
        }
 
        return array(
            'id' => $id,
            'form' => $form,
        );
    }


    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute($this->routeIndex);
        }
 
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
 
            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $model = $this->getEntityManager()->find(get_class($this->model), $id);
                if ($album) {
                    $this->getEntityManager()->remove($album);
                    $this->getEntityManager()->flush();
                }
            }
 
            // Redirect to list of albums
            return $this->redirect()->toRoute($this->routeIndex);
        }
 
        return array(
            'id'    => $id,
            'album' => $this->getEntityManager()->find(get_class($this->model), $id)
        );
    }
}