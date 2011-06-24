<?php

namespace Tui\DirectorsBundle\Repositories;

use Doctrine\ORM\EntityRepository;
use Tui\DirectorsBundle\Entity\Company;


/**
 * CompanyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompanyRepository extends EntityRepository
{
    /**
     * Get limited appointees
     *
     * @return Doctrine\Common\Collections\Collection $appointees
     */
    public function getAbbreviatedAppointees(Company $company, $limit = 5)
    {
          $q = $this->_em->createQuery('SELECT a
              FROM TuiDirectorsBundle:Appointee a 
              JOIN a.companyAppointments c
              WHERE c.companyId = :company
              ORDER BY c.appointedOn DESC');
          $q->setParameter('company', $company->getId());
          $q->setMaxResults( $limit );

        return $q->getResult();
    }
    
    
    
    public function getAppointments(Company $company, $limit = 100, $offset = 0)
    {
        $q = $this->_em->createQuery('SELECT ca, a
            FROM TuiDirectorsBundle:CompanyAppointment ca 
            JOIN ca.appointee a
            WHERE ca.companyId = :company
            ORDER BY ca.appointedOn DESC');
        $q->setParameter('company', $company->getId());
        $q->setFirstResult( $offset );
        $q->setMaxResults( $limit );
      
      return $q->getResult();
    }
    
    public function countAppointments(Company $company)
    {
        $qc = $this->_em->createQuery("SELECT COUNT(a.companyId) FROM TuiDirectorsBundle:CompanyAppointment a WHERE a.companyId = :company");
        $qc->setParameter('company', $company->getId());
        $result_array = $qc->getSingleResult();
        return array_shift($result_array);
    }
    
}