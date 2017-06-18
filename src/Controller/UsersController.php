<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 */
class UsersController extends AppController
{
    public function login()
    {
        if ($this->request->is('post'))
        {
            $user= $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else
            {
                $this->Flash->error('Datos invalidos, por favor intente nuevamente',['key'=>'Auth']);
            }
        }
    }  
    
    public function home()
    {
        $this->render();
    }        
    public function index()

	{
		//echo "listado de usuarios";
		//exit();
            $users = $this->paginate($this->Users);
            $this->set('users',$users);
	}

	public function view()
	{
		echo "Detalle de usuario";
		exit();
	}
        public function add()
        {
           $user= $this->Users->newEntity();
           if($this->request->is('post'))
           {
               //debug($this->request->data);
               $user= $this->Users->patchEntity($user,$this->request->data);
               
               if($this->Users->save($user))
               {
                    $user= $this->Flash->success('El Usuario a sido Creado Correctamente');
                    return $this->redirect(['controller' =>'Users','action' =>'index']);
               }
                else 
               {
                   $this->Flash->error('El usuario no pudo crearse intente nuevamente');
               }
               
           }
           
           
           $this->set(compact('user'));
            
            
            
        }
}
