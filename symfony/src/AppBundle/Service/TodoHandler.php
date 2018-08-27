<?php

namespace AppBundle\Service;

use AppBundle\Entity\Todo;
use AppBundle\Repository\TodoRepositoryInterface;
use Symfony\Component\Form\FormInterface;

class TodoHandler
{
    /** @var TodoRepositoryInterface */
    private $todoRepository;

    /**
     * TodoHandler constructor.
     * @param TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * @param FormInterface $form
     * @param Todo $todo
     */
    public function createATodo(FormInterface $form, Todo $todo)
    {
        $todo->setName($form['name']->getData());
        $todo->setDescription($form['description']->getData());
        $todo->setDueDate($form['dueDate']->getData());
        $todo->setCreatedAt(new \DateTime('now'));

        $this->todoRepository->save($todo);
    }

    /**
     * @param FormInterface $form
     * @param int $id
     */
    public function updateTodo(FormInterface $form, int $id)
    {
        $todo = $this->todoRepository->findOneById($id);
        $todo->setName($form['name']->getData());
        $todo->setDescription($form['description']->getData());
        $todo->setDueDate($form['dueDate']->getData());

        $this->todoRepository->save($todo);
    }

    /**
     * @param $id
     */
    public function removeTodo($id)
    {
        $todo = $this->todoRepository->findOneById($id);
        $this->todoRepository->remove($todo);
    }
}
