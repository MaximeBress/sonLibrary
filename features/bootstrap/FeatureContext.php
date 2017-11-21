<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use AppBundle\Entity\Book;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        // creer un book
        $this->livre = new Book();
        // creer un utilisateur
        $this->livre = new User();
        // connexion à la base
        $this->em = $this->getDoctrine()->getManager();
    }

    /**
     * @Given je suis connecté en tant qu'administrateur
     */
    public function jeSuisConnecteEnTantQuadministrateur()
    {
        throw new PendingException();
    }

    /**
     * @When j'ajoute un nouveau livre nommé :arg1 avec le résumé :arg2
     */
    public function jajouteUnNouveauLivreNommeAvecLeResume($arg1, $arg2)
    {
        $this->livre->setTitre($arg1);
        $this->livre->setDescription($arg1);

        $this->em->persist($this->livre);
        $this->em->flush();

        throw new PendingException();
    }

    /**
     * @Then je dois trouver mon nouveau livre :arg1 dans la liste
     */
    public function jeDoisTrouverMonNouveauLivreDansLaListe($arg1)
    {
        $livre = $this->em->getRepository("AppBundle:Book")->findOneByTitre($arg1);
        $this->em
        throw new PendingException();
    }

    /**
     * @Given il existe un livre nommé :arg1
     */
    public function ilExisteUnLivreNomme($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When j'édite la description du livre :arg1 pour devenir :arg2
     */
    public function jediteLaDescriptionDeCeLivrePourDevenir($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then le livre :arg1 doit maintenant avoir la nouvelle description :arg2
     */
    public function leLivreDoitMaintenantAvoirLaNouvelleDescription($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @When je supprime le livre :arg1
     */
    public function jeSupprimeCeLivre($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then ce livre :arg1 ne doit plus apparaître dans la liste des livres existants
     */
    public function ceLivreNeDoitPlusApparaitreDansLaListeDesLivresExistants($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When je consulte le livre :arg1
     */
    public function jeConsulteLeLivre($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then je peux lire le titre du livre :arg1 et sa description
     */
    public function jePeuxLireLeTitreDuLivreEtSaDescription($arg1)
    {
        throw new PendingException();
    }
}
