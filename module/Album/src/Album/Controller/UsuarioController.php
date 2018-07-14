<?php
namespace Album\Controller;
 
use Album\Model\Usuario;
use Zend\View\Model\ViewModel;
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
            $data = $request->getPost();

            //echo '<pre>'; var_dump($data); die;

            // // If you used another name for the authentication service, change it here
            $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

            $adapter = $authService->getAdapter();

            //echo "<pre>"; var_dump(get_class_methods($adapter)); die;
            $adapter->setIdentity($data['email']);
            $adapter->setCredential($data['password']);
            $authResult = $authService->authenticate();

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