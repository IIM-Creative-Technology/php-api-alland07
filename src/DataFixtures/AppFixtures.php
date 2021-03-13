<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Intervenant;
use App\Entity\Matiere;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $EM;
    private $CR;
    private $SR;
    private $IR;
    private $MR;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->EM = $em;
        $this->CR = $this->EM->getRepository(Classe::class);
        $this->SR = $this->EM->getRepository(Etudiant::class);
        $this->IR = $this->EM->getRepository(Intervenant::class);
        $this->MR = $this->EM->getRepository(Matiere::class);
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //Classes
        for ($i = 1; $i<=5;$i++){
            $classe = new Classe;
            $classe->setNomPromo('A'.$i);
            $classe->setAnneeSortie(2020 + $i);
            $manager->persist($classe);
        }
        $manager->flush();

        //Etudiants
        for ($i = 1; $i<=10;$i++){
            $student = new Etudiant;
            $random = rand(1,5);
            //Typage de $classe
            /** @var Classe $classe */
            $classe = $this->CR->findOneBy(['id'=>$random]);
            $student->setNom('Nom n°'.$i);
            $student->setPrenom('Prenom n°'.$i);
            $student->setAge(18);
            $student->setAnneeArrivee(2005+$i);
            $student->setPromo($classe);
            $manager->persist($student);
        }
        $manager->flush();

        //Intervenant
        for ($i = 1; $i<=10;$i++){
            $intervenant = new Intervenant;
            $intervenant->setNom( 'Nom Intervenant n°'.$i);
            $intervenant->setPrenom('Prenom Intervenant n°'.$i);
            $intervenant->setAnneeArrivee(2005 + $i);
            $manager->persist($intervenant);
        }
        $manager->flush();

        //Matieres
        for ($i = 1;$i<=5;$i++){
            $mat = new Matiere;

            /** @var Classe $classe */
            $classe = $this->CR->findOneBy(['id'=>$i]);

            /** @var Intervenant $intervenant */
            $intervenant = $this->IR->findOneBy(['id'=>$i]);

            $mat->setNom('Matiere n°'.$i);
            $dateUne = new \DateTime();
            $dateUne->setDate(2021,03,12);
            $dateDeux = new \DateTime();
            $dateDeux->setDate(2021,03,17);
            $mat->setDateDebut($dateUne);
            $mat->setDateFin($dateDeux);
            $mat->setClasse($classe);
            $mat->setIntervenant($intervenant);
            $manager->persist($mat);
        }
        $manager->flush();

        //Notes
          for ($i=1;$i<=5;$i++){
            $note = new Note;
            $note->setNote(random_int(0,20));

            /** @var Etudiant $student */
            $student = $this->SR->findOneBy(['id'=>$i]);
            $note->setEtudiant($student);

            /** @var Matiere $matiere */
            $matiere = $this->MR->findOneBy(['id'=>random_int(1,5)]);
            $note->setMatiere($matiere);

            $manager->persist($note);
        }
        $manager->flush();

        $users = array("Nicolas","Alexis","Karine");
        //Users
        for($i=1;$i<=3;$i++){
            $user = new User;
            $user->setEmail($users[$i-1].'@edu.devinci.fr');
            $user->setPassword($this->passwordEncoder->encodePassword($user,'password'));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
