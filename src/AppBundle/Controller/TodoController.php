<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



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

        $form = $this->createFormBuilder($todo)
                ->add('name', TextType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'], 'label' => 'Название задачи' ])
                ->add('category', TextType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'], 'label' => 'Категория' ])
                ->add('description', TextareaType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'], 'label' => 'Описание' ])
                ->add('priority', ChoiceType::class, ['choices' => ['Низкий' => 'Low', 'Средний' => 'Normal', 'Высокий' => 'High'], 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'], 'label' => 'Уровень приоритета' ])
                ->add('due_date', DateTimeType::class, ['attr' => ['style' => 'margin-bottom: 15px'], 'label' => 'Дата окончания' ])
                ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-info'], 'label' => 'Добавить задачу' ])
                ->getForm();

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Get Data
                    $name = $form['name']->getData();
                    $category = $form['category']->getData();
                    $description = $form['description']->getData();
                    $priority = $form['priority']->getData();
                    $due_date = $form['due_date']->getData();

                    $now = new \DateTime('now');

                    $todo->setName($name);
                    $todo->setCategory($category);
                    $todo->setDescription($description);
                    $todo->setPriority($priority);
                    $todo->setDueDate($due_date);
                    $todo->setCreateDate($now);

                    $em = $this->getDoctrine()->getManager();

                    $em->persist($todo);
                    $em->flush();

                    $this->addFlash(
                        'notice', 'Задача добавлена'
                    );

                    return $this->redirectToRoute('todo_list');
                }

        return $this->render('todo/create.html.twig', [
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id, Request $request)
    {
         $todo = $this->getDoctrine()->getRepository('AppBundle:Todo')->find($id);

        $now = new \DateTime('now');

        $todo->setName($todo->getName());
        $todo->setCategory($todo->getCategory());
        $todo->setDescription($todo->getDescription());
        $todo->setPriority($todo->getPriority());
        $todo->setDueDate($todo->getDueDate());
        $todo->setCreateDate($now);
        

         $form = $this->createFormBuilder($todo)
                ->add('name', TextType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom:15px'], 'label' => 'Название задачи' ])
                ->add('category', TextType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'], 'label' => 'Категория' ])
                ->add('description', TextareaType::class, ['attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'], 'label' => 'Описание' ])
                ->add('priority', ChoiceType::class, ['choices' => ['Низкий' => 'Low', 'Средний' => 'Normal', 'Высокий' => 'High'], 'attr' => ['class' => 'form-control', 'style' => 'margin-bottom: 15px'], 'label' => 'Уровень приоритета' ])
                ->add('due_date', DateTimeType::class, ['attr' => ['style' => 'margin-bottom: 15px'], 'label' => 'Дата окончания' ])
                ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-info'], 'label' => 'Обновить задачу' ])
                ->getForm();

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    // Get Data
                    $name = $form['name']->getData();
                    $category = $form['category']->getData();
                    $description = $form['description']->getData();
                    $priority = $form['priority']->getData();
                    $due_date = $form['due_date']->getData();

                    $now = new \DateTime('now');

                    $em = $this->getDoctrine()->getManager();
                    $todo = $em->getRepository('AppBundle:Todo')->find($id);

                    $todo->setName($name);
                    $todo->setCategory($category);
                    $todo->setDescription($description);
                    $todo->setPriority($priority);
                    $todo->setDueDate($due_date);
                    $todo->setCreateDate($now);



                    $em->flush();

                    $this->addFlash(
                        'notice', 'Задача изменена'
                    );

                    return $this->redirectToRoute('todo_list');
                }

        return $this->render('todo/create.html.twig', [
            'form' => $form->createView()
            ]);

        return $this->render('todo/edit.html.twig', [
            'todo' => $todo
        ]);;
    }

    /**
     * @Route("/todo/details/{id}", name="todo_details")
     */
    public function detailsAction($id)
    {
        $todo = $this->getDoctrine()->getRepository('AppBundle:Todo')->find($id);


        return $this->render('todo/details.html.twig', [
            'todo' => $todo
        ]);;
    }

    /**
     * @Route("/todo/delete/{id}", name="todo_delete")
     */
    public function deleteAction($id)
    {

    }
}
