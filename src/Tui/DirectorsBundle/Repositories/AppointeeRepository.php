<?php

namespace Tui\DirectorsBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Tui\DirectorsBundle\Entity\Appointee;

/**
 * AppointeeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AppointeeRepository extends EntityRepository
{
  
    public function countAppointments(Appointee $appointee)
    {
        $qc = $this->_em->createQuery("SELECT COUNT(a.companyId) FROM TuiDirectorsBundle:CompanyAppointment a WHERE a.appointeeId = :appointee");
        $qc->setParameter('appointee', $appointee->getId());
        $result_array = $qc->getSingleResult();
        return array_shift($result_array);
    }
 

    public function getAppointments(Appointee $appointee, $limit = 100, $offset = 0)
    {
        $q = $this->_em->createQuery('SELECT a, c 
            FROM TuiDirectorsBundle:CompanyAppointment a 
            JOIN a.company c
            WHERE a.appointeeId = :appointee
            ORDER BY a.appointedOn DESC');
        $q->setParameter('appointee', $appointee->getId());
        $q->setFirstResult( $offset );
        $q->setMaxResults( $limit );
      
      return $q->getResult();
    }


    /**
     * Get limited companyAppointments
     *
     * @return Doctrine\Common\Collections\Collection $companyAppointments
     */
    public function getAbbreviatedCompanies(Appointee $appointee, $limit = 5)
    {
          $q = $this->_em->createQuery('SELECT c 
              FROM TuiDirectorsBundle:Company c 
              JOIN c.companyAppointments a
              WHERE a.appointeeId = :appointee
              ORDER BY a.appointedOn DESC');
          $q->setParameter('appointee', $appointee->getId());
          $q->setMaxResults( $limit );

        return $q->getResult();
    }
 
}