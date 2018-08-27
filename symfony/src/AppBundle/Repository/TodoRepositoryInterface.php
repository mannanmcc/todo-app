<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Todo;

interface TodoRepositoryInterface
{
    /**
     * @param Todo $todo
     * @return void
     */
    public function save(Todo $todo);

    /**
     * @param Todo $todo
     * @return void
     */
    public function remove(Todo $todo);

    /**
     * @param int $id
     * @return Todo
     */
    public function findOneById($id);

    /**
     * @param string $name
     * @return []Todo
     */
    public function listOfTodos();
}
