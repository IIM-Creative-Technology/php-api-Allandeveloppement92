<?php

namespace App\DataFixtures;

use App\Entity\Intervenant;
use App\Entity\Promotion;
use App\Entity\Etudiant;
use App\Entity\Matiere;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //Utilisateurs
        $users = [
            1 => [
                'email' => 'nicolas.rauber@edu.devinci.fr', 
                'password' => 'NRDevinci',
                'apiKey' => 'keyNicolasRauber',
            ],
            2 => [
                'email' => 'alexis.bougy@edu.devinci.fr', 
                'password' => 'ABDevinci',
                'apiKey' => 'keyAlexisBougy',
            ],
            3 => [
                'email' => 'karine.mousdik@edu.devinci.fr', 
                'password' => 'KMDevinci',
                'apiKey' => 'keyKarineMousdik', 
            ],
        ];

        foreach($users as $key => $value){
            $user = new User(); 
            $user -> setEmail($value['email']);
            $user -> setPassword($this->passwordEncoder->encodePassword($user,'password'));
            $user -> setApiKey($value['apiKey']);
            $manager->persist($user);
        }

        //Promotions
        $promotions = [
            1 => [
                'nomPromo' => 'Promo A2', 
                'dateSortie' => 2024
            ],
            2 => [
                'nomPromo' => 'Promo A3', 
                'dateSortie' => 2023
            ],
            3 => [
                'nomPromo' => 'Promo A4', 
                'dateSortie' => 2022
            ],
            4 => [
                'nomPromo' => 'Promo A5', 
                'dateSortie' => 2021
            ],
        ];

        foreach($promotions as $key => $value){
            $promotion = new Promotion(); 
            $promotion -> setNomPromo($value['nomPromo']);
            $promotion -> setDateSortie($value['dateSortie']);
            $manager->persist($promotion);
        }

        //Etudiants
        $etudiants = [
            1 => [
                'nomEtudiant' => 'GERME', 
                'prenomEtudiant' => 'Allan', 
                'ageEtudiant' => '22',
                'arriveEtudiant'  => '2019'
            ],
            2 => [
                'nomEtudiant' => 'SOOCOORMANEE', 
                'prenomEtudiant' => 'Ridwan', 
                'ageEtudiant' => '22',
                'arriveEtudiant'  => '2019'
            ],
            3 => [
                'nomEtudiant' => 'MPIKA', 
                'prenomEtudiant' => 'Toshiro', 
                'ageEtudiant' => '20',
                'arriveEtudiant'  => '2019'
            ],
            4 => [
                'nomEtudiant' => 'GUERRIER', 
                'prenomEtudiant' => 'Quentin', 
                'ageEtudiant' => '23',
                'arriveEtudiant'  => '2018'
            ],
            5 => [
                'nomEtudiant' => 'MORALDI', 
                'prenomEtudiant' => 'Thomas', 
                'ageEtudiant' => '21',
                'arriveEtudiant'  => '2018'
            ],
            6 => [
                'nomEtudiant' => 'CORNIQUET', 
                'prenomEtudiant' => 'Hugo', 
                'ageEtudiant' => '21',
                'arriveEtudiant'  => '2018'
            ],
            7 => [
                'nomEtudiant' => 'DUPEY', 
                'prenomEtudiant' => 'Mathias', 
                'ageEtudiant' => '20',
                'arriveEtudiant'  => '2018'
            ],
            8 => [
                'nomEtudiant' => 'PUECH', 
                'prenomEtudiant' => 'Antoine', 
                'ageEtudiant' => '20',
                'arriveEtudiant'  => '2018'
            ],
            9 => [
                'nomEtudiant' => 'GILLES', 
                'prenomEtudiant' => 'Mathias', 
                'ageEtudiant' => '21',
                'arriveEtudiant'  => '2018'
            ],
            10 => [
                'nomEtudiant' => 'AELION', 
                'prenomEtudiant' => 'Pauline', 
                'ageEtudiant' => '20',
                'arriveEtudiant'  => '2018'
            ],
        ];
        
        foreach($etudiants as $key => $value){
            $etudiant = new Etudiant(); 
            $etudiant -> setNomEtudiant($value['nomEtudiant']);
            $etudiant -> setPrenomEtudiant($value['prenomEtudiant']);
            $etudiant -> setAgeEtudiant($value['ageEtudiant']);
            $etudiant -> setArriveeEtudiant($value['arriveEtudiant']);
            $manager->persist($etudiant);
        }

        //Intervenants
        $intervenants = [
            1 => [
                'nomIntervenant' => 'GRIMAUD', 
                'prenomIntervenant' => 'Pierre',
                'dateArriveeIntervenant' => 2014 
            ],
            2 => [
                'nomIntervenant' => 'COUALAN', 
                'prenomIntervenant' => 'Yoann',
                'dateArriveeIntervenant' => 2015 
            ],
            3 => [
                'nomIntervenant' => 'JACQUEMIN', 
                'prenomIntervenant' => 'Arthur',
                'dateArriveeIntervenant' => 2019 
            ],
            4 => [
                'nomIntervenant' => 'RIOTTOT', 
                'prenomIntervenant' => 'Guillaume',
                'dateArriveeIntervenant' => 2010 
            ],
            5 => [
                'nomIntervenant' => 'SOUYAD', 
                'prenomIntervenant' => 'Malik',
                'dateArriveeIntervenant' => 2007 
            ],
            6 => [
                'nomIntervenant' => 'GARIME', 
                'prenomIntervenant' => 'Mickael',
                'dateArriveeIntervenant' => 2008 
            ],
            7 => [
                'nomIntervenant' => 'BERGES', 
                'prenomIntervenant' => 'Claire',
                'dateArriveeIntervenant' => 2020 
            ],
            8 => [
                'nomIntervenant' => 'DANE', 
                'prenomIntervenant' => 'Christophe',
                'dateArriveeIntervenant' => 2015 
            ],
            9 => [
                'nomIntervenant' => 'MOIZARD', 
                'prenomIntervenant' => 'FADELA',
                'dateArriveeIntervenant' => 2009 
            ],
            10 => [
                'nomIntervenant' => 'ZINGA', 
                'prenomIntervenant' => 'Boubakar',
                'dateArriveeIntervenant' => 2021 
            ],
        ];

        foreach($intervenants as $key => $value){
            $intervenant = new Intervenant(); 
            $intervenant -> setNomIntervenant($value['nomIntervenant']);
            $intervenant -> setPrenomIntervenant($value['prenomIntervenant']);
            $intervenant -> setDateArriveeIntervenant($value['dateArriveeIntervenant']);
            $manager->persist($intervenant);
        }

        //Matières
        $matieres = [
            1 => [
                'nomCours' => 'API PHP', 
                'debutCours' => new \DateTime("2020-09-07 09:00:00"), 
                'finCours' => new \DateTime("2020-09-11 17:00:00")
            ],
            2 => [
                'nomCours' => 'REACT JS', 
                'debutCours' => new \DateTime("2020-10-05 09:00:00"),
                'finCours' => new \DateTime("2020-10-09 17:00:00")
            ],
            3 => [
                'nomCours' => 'SYMFONY', 
                'debutCours' => new \DateTime("2020-11-02 09:00:00"), 
                'finCours' => new \DateTime("2020-11-06 17:00:00")
            ],
            4 => [
                'nomCours' => 'NODE JS', 
                'debutCours' => new \DateTime("2020-11-30 09:00:00"), 
                'finCours' => new \DateTime("2020-12-04 17:00:00")
            ],
        ];

        foreach($matieres as $key => $value){
            $matiere = new Matiere(); 
            $matiere -> setNomCours($value['nomCours']);
            $matiere -> setDebutCours($value['debutCours']);
            $matiere -> setFinCours($value['finCours']);
            $manager->persist($matiere);
        }

        //Notes
        for ($i = 1; $i <= 20; $i++) {
            $task = new Note;
            $task->setNote($i . "/20");
            $manager->persist($task);
        }

        $manager->flush();
    }
}
