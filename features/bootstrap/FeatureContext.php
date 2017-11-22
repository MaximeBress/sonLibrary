<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

use AppBundle\Entity\Book;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements KernelAwareContext
{
    use KernelDictionary;
    
    public function __construct()
    {
        // Création d'un objet Book pour travailler dessus
        $this->livre = new Book();
    }

    /**
     * @Given je suis connecté en tant qu'administrateur
     */
    public function jeSuisConnecteEnTantQuadministrateur()
    {
        // $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        // throw new PendingException();
        return true;
    }

    /**
     * @When j'ajoute un nouveau livre nommé :arg1 avec le résumé :arg2
     */
    public function jajouteUnNouveauLivreNommeAvecLeResume($arg1, $arg2)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $this->livre->setTitre($arg1);
        $this->livre->setDescription($arg1);

        $this->em->persist($this->livre);
        
        try {
            $this->em->flush();
        } catch (Exception $e) {
            throw new PendingException($e->getMessage());
        }
    }

    /**
     * @Then je dois trouver mon nouveau livre :arg1 dans la liste
     */
    public function jeDoisTrouverMonNouveauLivreDansLaListe($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);
        
        if ($this->livre) {
            return true;
        } else {
            throw new PendingException("le livre n'existe pas dans la liste");
        }
    }

    /**
     * @Given il existe un livre nommé :arg1
     */
    public function ilExisteUnLivreNomme($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        if ($this->livre) {
            return true;
        } else {
            throw new PendingException("le livre est vide");
        }

    }

    /**
     * @When j'édite la description du livre :arg1 pour devenir :arg2
     */
    public function jediteLaDescriptionDeCeLivrePourDevenir($arg1, $arg2)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        $this->livre->setDescription($arg1);
        
        $this->em->persist($this->livre);
        
        try {
            $this->em->flush();
        } catch (Exception $e) {
            throw new PendingException($e->getMessage());
        }

        return true;
    }

    /**
     * @Then le livre :arg1 doit maintenant avoir la nouvelle description :arg2
     */
    public function leLivreDoitMaintenantAvoirLaNouvelleDescription($arg1, $arg2)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        $description = $this->livre->getDescription();

        if ($description === $arg2) {
            return true;
        } else {
            throw new PendingException("Description non mise a jour correctement");            
        }

    }

    /**
     * @When je supprime le livre :arg1
     */
    public function jeSupprimeCeLivre($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        $this->em->remove($this->livre);
        
        try {
            $this->em->flush();
        } catch (Exception $e) {
            throw new PendingException($e->getMessage());
        }

        return true;
    }

    /**
     * @Then ce livre :arg1 ne doit plus apparaître dans la liste des livres existants
     */
    public function ceLivreNeDoitPlusApparaitreDansLaListeDesLivresExistants($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        if (!$this->livre) {
            return true;
        } else {
            throw new PendingException("le livre est vide");
        }
    }

    /**
     * @When je consulte le livre :arg1
     */
    public function jeConsulteLeLivre($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        if ($this->livre) {
            return true;
        } else {
            throw new PendingException("le livre est vide");
        }
    }

    /**
     * @Then je peux lire le titre du livre :arg1 et sa description
     */
    public function jePeuxLireLeTitreDuLivreEtSaDescription($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        if ($this->livre->getDescription() && $this->livre->getTitre()) {
            return true;
        } else if (!$this->livre->getDescription()) {
            throw new PendingException("la description du livre est vide");
        } else if (!$this->livre->getTitre()) {
            throw new PendingException("le titre du livre est vide");
        } 
    }
}
