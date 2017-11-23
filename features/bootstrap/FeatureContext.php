<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;


use AppBundle\Entity\Book;
use UserBundle\Entity\User;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements KernelAwareContext
{
    use KernelDictionary;

    protected $livre;
    protected $bibliotheque;
    protected $user;
    protected $em;
    protected $container;
    
    public function __construct()
    {
        // $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        // $this->container = $this->getContainer();
    }

    /**
     * @Given je suis connecté en tant que :arg1
     */
    public function jeSuisConnecteEnTantQuadministrateur($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->container = $this->getContainer();

        $this->user = $this->em->getRepository('UserBundle:user')->findOneByUsername($arg1);

        if ($this->user) {
            return $this->user;
        } else {
            throw new PendingException("l'utilisateur $arg1 n'existe pas");            
        }
    }

    /**
     * @When j'ajoute un nouveau livre nommé :arg1 avec le résumé :arg2
     */
    public function jajouteUnNouveauLivreNommeAvecLeResume($arg1, $arg2)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->container = $this->getContainer();

        $this->livre = new Book();
        $this->livre->setTitre($arg1);
        $this->livre->setDescription($arg2);
        $this->livre->setUser($this->user);

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
        $this->container = $this->getContainer();

        $this->bibliotheque = $this->em->getRepository("AppBundle:Book")->findByUser($this->user->getId());
        
        foreach ($this->bibliotheque as $livre) {
            if ($livre->getTitre() === $arg1)
                return true;
        }

        // return false;
        throw new PendingException("le livre n'existe pas dans la liste");
    }

    /**
     * @Given il existe un livre nommé :arg1
     */
    public function ilExisteUnLivreNomme($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->container = $this->getContainer();

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
        $this->container = $this->getContainer();

        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        $this->livre->setDescription($arg2);
        
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
        $this->container = $this->getContainer();

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
        $this->container = $this->getContainer();

        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);
        $this->em->remove($this->livre);
    
        try {
            $this->em->flush();
            $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);
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
        $this->container = $this->getContainer();

        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        // var_dump($this->livre);


        if ($this->livre) {
            throw new PendingException("le livre existe toujours");
        } else {
            return true;
        }
    }

    /**
     * @When je consulte le livre :arg1
     */
    public function jeConsulteLeLivre($arg1)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->container = $this->getContainer();

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
        $this->container = $this->getContainer();

        $this->livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);

        if ($this->livre->getDescription() && $this->livre->getTitre()) {
            return true;
        } else if (!$this->livre->getDescription()) {
            throw new PendingException("la description du livre est vide");
        } else if (!$this->livre->getTitre()) {
            throw new PendingException("le titre du livre est vide");
        } 
    }

    /**
     * @When j'ajoute un livre nommé :arg1 avec le résumé :arg2
     */
    public function jajouteUnLivreNommeAvecLeResume($arg1, $arg2)
    {
        return $this->jajouteUnNouveauLivreNommeAvecLeResume($arg1, $arg2);
    }

    /**
     * @Then je dois trouver mon livre nommé :arg1 dans la liste
     */
    public function jeDoisTrouverMonLivreNommeDansLaListe($arg1)
    {
        return $this->jeDoisTrouverMonNouveauLivreDansLaListe($arg1);
    }

    /**
     * @When j'édite la description du livre nommé :arg1 pour devenir :arg2
     */
    public function jediteLaDescriptionDuLivreNommePourDevenir($arg1, $arg2)
    {
        return $this->jediteLaDescriptionDeCeLivrePourDevenir($arg1, $arg2);
    }

    /**
     * @When je supprime le livre nommé :arg1
     */
    public function jeSupprimeLeLivreNomme($arg1)
    {
        return $this->jeSupprimeCeLivre($arg1);
    }

    /**
     * @Then le livre nommé :arg1 ne doit plus exister
     */
    public function leLivreNommeNeDoitPlusExister($arg1)
    {
        return $this->ceLivreNeDoitPlusApparaitreDansLaListeDesLivresExistants($arg1);
    }

    /**
     * @Given j'avais ajouté un livre nommé :arg1 avec le résumé :arg2
     */
    public function javaisAjouteUnLivreNommeAvecLeResume($arg1, $arg2)
    {
        return $this->jajouteUnNouveauLivreNommeAvecLeResume($arg1, $arg2);
    }

}
