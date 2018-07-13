<?php
namespace Album\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

abstract class BaseController extends AbstractActionController
{
    /**
    * @var DoctrineORMEntityManager
    */
    protected $em;
    protected $model;
    protected $routeIndex;

    private function getEntityManager()
    {
        if (null == $this->em) {
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
        $request = $this->getRequest();

        if($request->isPost()) 
        {      
            try
            {
                //TODO: Validação dos dados vindo view.
                $this->model->exchangeArray($request->getPost());
                $this->getEntityManager()->persist($this->model);
                $this->getEntityManager()->flush();
                // Redirect to list
                return $this->redirect()->toRoute($this->routeIndex);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();    
            }
        }
        return new ViewModel(array('m' => $this->$model));
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) 
        {
            return $this->redirect()->toRoute($this->routeIndex, array(
                'action' => 'add'
            ));
        }
 
        $model = $this->getEntityManager()->find(get_class($this->model), $id);
        if (!$model) 
        {
            return $this->redirect()->toRoute($this->routeIndex, array(
                'action' => 'index'
            ));
        }
 
        $request = $this->getRequest();
        if ($request->isPost())
        {
            try
            {
                //TODO: Validação dos dados vindo view.
                $model->exchangeArray($request->getPost());
                $this->getEntityManager()->flush();
                // Redirect to list of albums
                return $this->redirect()->toRoute($this->routeIndex);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();    
            }
        }
        return new ViewModel(array('m' => $model));
    }


    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) 
        {
            return $this->redirect()->toRoute($this->routeIndex);
        }
 
        $request = $this->getRequest();
        if ($request->isPost()) 
        {
            try
            {
                $del = $request->getPost('del', 'Não');
                if ($del == 'Sim') 
                {
                    $id = (int) $request->getPost('id');
                    $model = $this->getEntityManager()->find(get_class($this->model), $id);
                    if ($model) 
                    {
                        $this->getEntityManager()->remove($model);
                        $this->getEntityManager()->flush();
                    }
                }
                // Redirect to list of albums
                return $this->redirect()->toRoute($this->routeIndex);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();    
            }
        }
        
        return new ViewModel(
            array('m' => $this->getEntityManager()->find(get_class($this->model), $id))
        );
    }
}