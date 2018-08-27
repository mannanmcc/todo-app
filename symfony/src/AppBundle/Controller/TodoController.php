<?php

namespace AppBundle\Controller;

use AppBundle\Form\TodoType;
use AppBundle\Repository\TodoRepositoryInterface;
use AppBundle\Service\TodoHandler;
use AppBundle\Entity\Todo;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    /**
     * @param TodoRepositoryInterface $todoRepository
     * @return Response
     */
    public function listAction(TodoRepositoryInterface $todoRepository)
    {
        $todoList = $todoRepository->listOfTodos();

        return $this->render('todo/index.html.twig', array('todos' => $todoList));
    }

    /**
     * @param Request $request
     * @param TodoHandler $todoHandler
     * @return Response
     */
    public function createAction(Request $request, TodoHandler $todoHandler)
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todoHandler->CreateATodo($form, $todo);
            $this->addFlash('notice', 'Todo added');

            return $this->redirectToRoute('todo_list');
        }

        return $this->render('todo/create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param TodoRepositoryInterface $todoRepository
     * @param TodoHandler $todoHandler
     * @return Response
     */
    public function editAction($id, Request $request, TodoRepositoryInterface $todoRepository, TodoHandler $todoHandler)
    {
        $todo = $todoRepository->findOneById($id);
        $form = $this->createForm(TodoType::class, $todo, ['label' => 'Save task']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todoHandler->updateTodo($form, $id);
            $this->addFlash('notice', 'Todo updated');

            return $this->redirectToRoute('todo_list');
        }

        return $this->render('todo/edit.html.twig', array(
            'todo' => $todo,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param int $id
     *
     * @param TodoRepositoryInterface $todoRepository
     * @return Response
     */
    public function detailsAction($id, TodoRepositoryInterface $todoRepository)
    {
        $todo = $todoRepository->findOneById($id);

        return $this->render('todo/details.html.twig', array('todo' => $todo));
    }

    /**
     * @param int $id
     *
     * @param TodoHandler $todoHandler
     * @return Response
     */
    public function deleteAction($id, TodoHandler $todoHandler)
    {
        $todoHandler->removeTodo($id);
        $this->addFlash('notice', 'Todo removed');

        return $this->redirectToRoute('todo_list');
    }
}
