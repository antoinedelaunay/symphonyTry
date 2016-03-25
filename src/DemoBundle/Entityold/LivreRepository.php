<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DemoBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * Description of LivreRepository
 *
 * @author sollivier
 */
class LivreRepository extends EntityRepository {

    public function getAllTitres(){
        //$em = $this->getEntityManager();
        //$query = $em->createQuery('SELECT bouquin FROM DemoBundle:Livre bouquin');
        //return $query->getResult();
        
        $builder = $this->createQueryBuilder('livre');
        return $builder->getQuery()->getResult();
        
    }
}
