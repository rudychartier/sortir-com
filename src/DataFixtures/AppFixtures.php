<?php
namespace App\DataFixtures;
use App\Entity\Campus;
use App\Entity\Etats;
use App\Entity\Lieux;
use App\Entity\Sorties;
use App\Entity\Participants;
use App\Entity\Villes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{
 private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
         //--> ETAT <--
        // libelle
        $etat1 = new Etats();
        $etat1->setLibelle("Créée");
        $manager->persist($etat1);
        $etat2 = new Etats();
        $etat2->setLibelle("Ouverte");
        $manager->persist($etat2);
        $etat3 = new Etats();
        $etat3->setLibelle("Clôturée");
        $manager->persist($etat3);
        $etat4 = new Etats();
        $etat4->setLibelle("En cours");
        $manager->persist($etat4);
        $etat5 = new Etats();
        $etat5->setLibelle("Passée");
        $manager->persist($etat5);
        $etat6 = new Etats();
        $etat6->setLibelle("Annulée");
        $manager->persist($etat6);

        //--> CAMPUS <--
        // nom
        $campus1 = new Campus();
        $campus1->setNomCampus("SAINT HERBLAIN");
        $manager->persist($campus1);
        $campus2 = new Campus();
        $campus2->setNomCampus("CHARTRES DE BRETAGNE");
        $manager->persist($campus2);
        $campus3 = new Campus();
        $campus3->setNomCampus("LA ROCHE SUR YON");
        $manager->persist($campus3);
        $faker = Faker\Factory::create('fr_FR');
        //--> VILLE <--
        // nom, codePostal
        $ville1 = new Villes();
        $ville1->setNomVille("SAINT HERBLAIN");
        $ville1->setCodePostal("44800");
        $manager->persist($ville1);
        $ville2 = new Villes();
        $ville2->setNomVille("CHARTRES DE BRETAGNE");
        $ville2->setCodePostal("35131");
        $manager->persist($ville2);
        $ville3 = new Villes();
        $ville3->setNomVille("LA ROCHE SUR YON");
        $ville3->setCodePostal("85000");
        $manager->persist($ville3);
        $ville4 = new Villes();
        $ville4->setNomVille("NANTES");
        $ville4->setCodePostal("44000");
        $manager->persist($ville4);
        $ville5 = new Villes();
        $ville5->setNomVille("PARIS");
        $ville5->setCodePostal("75000");
        $manager->persist($ville5);

        //--> LIEU <--
        // nom, rue, latitude, longitude, ville
        for ($i = 1; $i < 21; $i++) {
            $lieu = new Lieux();
            $lieu->setNomLieu("Lieu de SAINT HERBLAIN n°".$i);
            $lieu->setRue($faker->streetAddress);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $lieu->setVille($ville1);
            $manager->persist($lieu);
        }
        for ($i = 1; $i < 21; $i++) {
            $lieu = new Lieux();
            $lieu->setNomLieu("Lieu de CHARTRES DE BRETAGNE n°".$i);
            $lieu->setRue($faker->streetAddress);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $lieu->setVille($ville2);
            $manager->persist($lieu);
        }
        for ($i = 1; $i < 21; $i++) {
            $lieu = new Lieux();
            $lieu->setNomLieu("Lieu de LA ROCHE SUR YON n°".$i);
            $lieu->setRue($faker->streetAddress);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $lieu->setVille($ville3);
            $manager->persist($lieu);
        }
        for ($i = 1; $i < 21; $i++) {
            $lieu = new Lieux();
            $lieu->setNomLieu("Lieu de NANTES n°".$i);
            $lieu->setRue($faker->streetAddress);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $lieu->setVille($ville4);
            $manager->persist($lieu);
        }
        for ($i = 1; $i < 21; $i++) {
            $lieu = new Lieux();
            $lieu->setNomLieu("Lieu de PARIS n°".$i);
            $lieu->setRue($faker->streetAddress);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $lieu->setVille($ville5);
            $manager->persist($lieu);
        }
        //--------------------------------------------------------------------
        //--> UTILISATEUR <--
        $utilisateur1 = new Participants();
        $utilisateur1->setPseudo("JeanWeb");
        $utilisateur1->setNom("Hublart");
        $utilisateur1->setPrenom("Jean");
        $utilisateur1->setEmail("jean.hublart2020@campus-eni.fr");
        $utilisateur1->setTelephone("0611223344");
        $utilisateur1->setCampus($campus1);
        $utilisateur1->setAdministrateur(1);
        $utilisateur1->setActif(1);

        $utilisateur1->setRoles([]);
        $password = $this->encoder->encodePassword($utilisateur1, "123456");
        $utilisateur1->setPassword($password);
        $manager->persist($utilisateur1);
        //--> UTILISATEUR <--
        $utilisateur2 = new Participants();
        $utilisateur2->setPseudo("GrekossWeb");
        $utilisateur2->setNom("Duffet");
        $utilisateur2->setPrenom("Greg");
        $utilisateur2->setEmail("gregory.duffet2020@campus-eni.fr");
        $utilisateur2->setTelephone("0622334455");
        $utilisateur2->setCampus($campus2);
        $utilisateur2->setAdministrateur(1);
        $utilisateur2->setActif(1);

        $utilisateur2->setRoles([]);
        $password = $this->encoder->encodePassword($utilisateur2, "123456");
        $utilisateur2->setPassword($password);
        $manager->persist($utilisateur2);
        //--> UTILISATEUR <--
        $utilisateur3 = new Participants();
        $utilisateur3->setPseudo("StephWeb");
        $utilisateur3->setNom("Guirous");
        $utilisateur3->setPrenom("Stéphane");
        $utilisateur3->setEmail("stephane.guirous2020@campus-eni.fr");
        $utilisateur3->setTelephone("0633445566");
        $utilisateur3->setCampus($campus3);
        $utilisateur3->setAdministrateur(1);
        $utilisateur3->setActif(1);

        $utilisateur3->setRoles([]);
        $password = $this->encoder->encodePassword($utilisateur3, "123456");
        $utilisateur3->setPassword($password);
        $manager->persist($utilisateur3);

        //TODO Generer une date aléatoire en le : "2019-01-01" et le : "2021-12-24"
        $dateMin = strtotime("2019-01-01");
        $dateMax = strtotime("2021-12-24");
        $dateAleatoire = mt_rand($dateMin, $dateMax);
        $dateFormater = date("Y-m-d H:m:s", $dateAleatoire);
        $dateOk = new \DateTime($dateFormater);
        //TODO ######################################################################



        //--> SORTIE <--
        // nom, dateHeureDebut, duree, dateLimiteInscription, nbInscriptionMax, infosSortie, etat, organisateur, campus, etat, lieu
        for ($i = 1; $i < 51; $i++) {
            $sortie = new Sorties();
            $sortie->setNom($faker->text($maxNbChars = 20));
            $sortie->setDatedebut($dateOk); //TODO creation au moin une semaine avant la date de sortie
            $sortie->setDuree(rand(60, 480));
            $sortie->setDatecloture($dateOk);
            $sortie->setNbInscriptionsMax(rand(10, 40));
            $sortie->setDescriptioninfos($faker->text($maxNbChars = 100));
            $utilisateur1->addSortiesOrganisee($sortie);
            $sortie->setCampus($campus1);
            $sortie->setEtat($etat1);
            $sortie->setLieux($lieu);
            $manager->persist($sortie);
        }
        for ($i = 1; $i < 51; $i++) {
            $sortie = new Sorties();
            $sortie->setNom($faker->text($maxNbChars = 20));
            $sortie->setDatedebut($dateOk); //TODO creation au moin une semaine avant la date de sortie
            $sortie->setDuree(rand(60, 480));
            $sortie->setDatecloture($dateOk);
            $sortie->setNbInscriptionsMax(rand(10, 40));
            $sortie->setDescriptioninfos($faker->text($maxNbChars = 100));
            $utilisateur2->addSortiesOrganisee($sortie);
            $sortie->setCampus($campus2);
            $sortie->setEtat($etat1);
            $sortie->setLieux($lieu);
            $manager->persist($sortie);
        }
        for ($i = 1; $i < 51; $i++) {
            $sortie = new Sorties();
            $sortie->setNom($faker->text($maxNbChars = 20));
            $sortie->setDatedebut($dateOk); //TODO creation au moin une semaine avant la date de sortie
            $sortie->setDuree(rand(60, 480));
            $sortie->setDatecloture($dateOk);
            $sortie->setNbInscriptionsMax(rand(10, 40));
            $sortie->setDescriptioninfos($faker->text($maxNbChars = 100));
            $utilisateur3->addSortiesOrganisee($sortie);
            $sortie->setCampus($campus3);
            $sortie->setEtat($etat1);
            $sortie->setLieux($lieu);
            $manager->persist($sortie);
        }
        $manager->flush();
    }
}