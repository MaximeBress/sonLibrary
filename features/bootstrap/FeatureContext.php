<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

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
        throw new PendingException();
    }

    /**
     * @Then je dois trouver mon nouveau livre dans la liste
     */
    public function jeDoisTrouverMonNouveauLivreDansLaListe()
    {
        throw new PendingException();
    }

    /**
     * @Given je suis connecté en tant qu"administrateur
     */
    public function jeSuisConnecteEnTantQuAdministrateur()
    {
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
     * @When j'édite la description de ce livre pour devenir :arg1
     */
    public function jediteLaDescriptionDeCeLivrePourDevenir($arg1)
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
     * @When je supprime ce livre
     */
    public function jeSupprimeCeLivre()
    {
        throw new PendingException();
    }

    /**
     * @Then ce livre ne doit plus apparaître dans la liste des livres existants
     */
    public function ceLivreNeDoitPlusApparaitreDansLaListeDesLivresExistants()
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
     * @Then je peux lire le titre du livre et sa description
     */
    public function jePeuxLireLeTitreDuLivreEtSaDescription()
    {
        throw new PendingException();
    }
}
