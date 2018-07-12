<?php
namespace Album\Controller;

use Zend\Mvc\MvcEvent;
use Album\Model\Funcionario;
use Zend\View\Model\ViewModel;
use Zend\Db\ResultSet\ResultSet;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\Controller\AbstractActionController;
#https://www.devmedia.com.br/criando-um-crud-com-zend-framework-2-e-doctrine-2/32100
class FuncionarioController extends AbstractActionController
{
    public function listarAction()
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $lista = $em->getRepository("Album\Model\Funcionario")->findAll();
        return new ViewModel(array('lista' => $lista));
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $result = array();
        if($request->isPost())
        {
            try{
                $nome = $request->getPost("nome");
                $cpf = $request->getPost("cpf");
                $salario = $request->getPost("salario");
  
                $funcionario = new Funcionario();
                $funcionario->setNome($nome);
                $funcionario->setCpf($cpf);
                $funcionario->setSalario($salario);
  
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                $em->persist($funcionario);
                $em->flush();
  
                $result["resp"] = $nome. ", enviado corretamente!";
            }  catch (Exception $e){
                 
            }
        }
         
        return new ViewModel($result);
    }

    public function excluirAction()
    {
        $id = $this->params()->fromRoute("id", 0);
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $funcionario = $em->find("Album\Model\Funcionario", $id);
        $em->remove($funcionario);
        $em->flush();
         
        return $this->redirect()->toRoute('funcionario', 
        array('controller' => 'index', 'action' => 'listar'));
    }
     
    public function editarAction()
    {
        $id = $this->params()->fromRoute("id", 0);
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
         
        $funcionario = $em->find("Album\Model\Funcionario", $id);
        $request = $this->getRequest();
        if($request->isPost())
        {
            try{
                $nome = $request->getPost("nome");
                $cpf = $request->getPost("cpf");
                $salario = $request->getPost("salario");
  
                $funcionario->setNome($nome);
                $funcionario->setCpf($cpf);
                $funcionario->setSalario($salario);
  
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                $em->merge($funcionario);
                $em->flush();
  
            }  
            catch (Exception $e)
            {
                 
            }
             
            return $this->redirect()->toRoute('funcionario', 
                array('controller' => 'index', 'action' => 'listar'));
        }
         
        return new ViewModel(array('f' => $funcionario));
    }
}