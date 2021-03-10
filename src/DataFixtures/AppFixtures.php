<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Intervenant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i<=10;$i++){
            $classe = new Classe;
            $classe->setNomPromo('Promo n°'.$i);
            $classe->setAnneeSortie(2000 + $i);
            $manager->persist($classe);
        }

        for ($i = 1; $i<=10;$i++){
            $student = new Etudiant;
            $student->setNom('Nom n°'.$i);
            $student->setPrenom('Prenom n°'.$i);
            $student->setAge(18);
            $student->setAnneeArrivee(2005+$i);
            $student->setPromo();
            $manager->persist($student);
        }

        for ($i = 1; $i<=10;$i++){
            $intervenant = new Intervenant;
            $intervenant->setNom( 'Nom Intervenant n°'.$i);
            $intervenant->setPrenom('Prenom Intervenant n°'.$i);
            $intervenant->setAnneeArrivee(2005 + $i);
            $manager->persist($intervenant);
        }

        $manager->flush();
    }
}
