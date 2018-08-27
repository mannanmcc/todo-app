<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Todo;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Common\Persistence\ManagerRegistry;

class TodoRepository implements TodoRepositoryInterface
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * TodoRepository constructor.
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @return EntityManager
     */
    protected function getManager()
    {
        return $this->managerRegistry->getManagerForClass(Todo::class);
    }

    /**
     * @param Todo $todo
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Todo $todo)
    {
        $this->getManager()->persist($todo);
        $this->getManager()->flush($todo);
    }

    /**
     * @param int $id
     * @return Todo
     */
    public function findOneById($id)
    {
        return $this->getManager()->getRepository(Todo::class)->find($id);
    }

    /**
     * @param Todo $todo
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Todo $todo)
    {
        $this->getManager()->remove($todo);
        $this->getManager()->flush($todo);
    }

    /**
     * @return Todo[]|array []Todo
     */
    public function listOfTodos()
    {
        return $this->getManager()->getRepository(Todo::class)->findBy(array(), array('id' => 'DESC'));
    }
}
