<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PreguntaRepository
 */
class PreguntaRepository extends \Doctrine\ORM\EntityRepository
{
  public function findByWords($word, $num)
  {
      $query = $this->getEntityManager()
          ->createQuery(
          'SELECT p, o, e FROM App:Pregunta p
          JOIN p.opciones o
          LEFT JOIN p.etiquetas e
          WHERE p.texto LIKE :word'
      )->setParameter('word', '%'.$word.'%');

      try {
          return $query->getResult();
      } catch (\Doctrine\ORM\NoResultException $e) {
          return null;
      }
  }
}