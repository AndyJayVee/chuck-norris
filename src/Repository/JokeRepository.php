<?php

namespace App\Repository;

use App\Entity\Joke;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method Joke|null find($id, $lockMode = null, $lockVersion = null)
 * @method Joke|null findOneBy(array $criteria, array $orderBy = null)
 * @method Joke[]    findAll()
 * @method Joke[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JokeRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        $this->entityManager = $registry->getManager();
        parent::__construct($registry, Joke::class);
    }

    public function saveAll(array $jokes)
    {
        foreach($jokes as $joke) {
            $this->save($joke);
        }
    }

    /**
     * @param Joke $joke
     * @return void
     */
    public function save(Joke $joke): void
    {
        $this->entityManager->persist($joke);
        $this->entityManager->flush();
    }

    /**
     * @param Joke $joke
     * @return void
     */
    public function remove(Joke $joke): void
    {
        $this->entityManager->remove($joke);
        $this->entityManager->flush();
    }
}
