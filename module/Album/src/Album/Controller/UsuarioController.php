<?php
namespace Album\Controller;
 
use Album\Model\Usuario;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;

class UsuarioController extends AbstractActionController
{
    public static function verifyCredential(Usuario $user, $inputPassword) 
    {
        return password_verify($inputPassword, $user->getPassword());
    }

    public function indexAction()
    {
        $request = $this->getRequest();

        if($request->isPost()) 
        { 

            $adapter = $this->authenticationService->getAdapter();
            $adapter->setIdentity($data['login']);
            $adapter->setCredential($data['password']);
            $authResult = $this->authenticationService->authenticate();

            $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

            $adapter = $authService->getAdapter();

            if ($authResult->isValid()) {
                return $this->redirect()->toRoute('album');
            }

            return new ViewModel(array(
                'error' => 'Your authentication credentials are not valid',
            ));
        }
        return new ViewModel();
    }
}