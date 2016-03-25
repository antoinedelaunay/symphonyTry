<?php

namespace Blog\FrontBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class Repository extends EntityRepository {

    public function lastElementPost($nbPosts) {
        return $this->getEntityManager()
                        ->createQuery('SELECT p FROM FrontBundle:Post p ORDER BY p.id DESC')
                        //->setMaxResults($nbPosts)
                        ->getResult();
        //->getArrayResult();
    }

    public function getPost($id) {
        $query = $this->getEntityManager()
                ->createQuery('SELECT p FROM FrontBundle:Post p WHERE p.id = :id');
        $query->setParameter('id', $id);
        return $query->getResult();
        //->getArrayResult();
    }

    public function getComment($postId) {
        $query = $this->getEntityManager()
                ->createQuery('SELECT p FROM FrontBundle:Comment p WHERE p.post = :postId');
        $query->setParameter('postId', $postId);
        return $query->getResult();
        //->getArrayResult();
    }

    public function getAllComment() {
        $query = $this->getEntityManager()
                ->createQuery('SELECT p FROM FrontBundle:Comment p');
        return $query->getResult();
        //->getArrayResult();
    }

    public function getAllUserSortByName() {
        $query = $this->getEntityManager()
                ->createQuery('SELECT p FROM FrontBundle:User p ORDER BY p.lastname DESC');
        return $query->getResult();
    }

    public function deleteComment($id) {
        $query = $this->getEntityManager()
                ->createQuery('DELETE FROM FrontBundle:Comment p WHERE p.id = :id');
        $query->setParameter('id', $id);
        return $query->getResult();
    }

}
