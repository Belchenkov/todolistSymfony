<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     */
    public function listAction()
    {
        $todos = $this->getDoctrine()->getRepository('AppBundle:Todo')->findAll();


        return $this->render('todo/index.html.twig', [
            'todos' => $todos
        ]);
    }

    /**
     * @Route("/todo/create", name="todo_create")
     */
    public function createAction(Request $request)
    {

        $todo = new Todo;

        $form = $this->createFormBuider($todo)
                ->add('name', TextType:class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'] ])
                ->add('category', TextType:class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'] ])
                ->add('description', TextType:class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'] ])
                ->add('name', TextareaType:class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'] ])
                ->add('priority', ChoiceType:class, ['choices' => ['Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'], 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'] ])
        
        return $this->render('todo/create.html.twig');
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id, Request $request)
    {
        return $this->render('todo/edit.html.twig');
    }

    /**
     * @Route("/todo/details/{id}", name="todo_details")
     */
    public function detailsAction($id)
    {
        return $this->render('todo/details.html.twig');
    }

    /**
     * @Route("/todo/delete/{id}", name="todo_delete")
     */
    public function deleteAction($id)
    {

    }
}
