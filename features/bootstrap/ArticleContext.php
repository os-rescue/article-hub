<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Element\DocumentElement;
use Behatch\Context\RestContext;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleContext implements Context
{
    private const ARTICLE_RESOURCE_IRI = '/api/articles';
    private const COMMENT_RESOURCE_IRI = '/api/articles/%d/comments';

    private static $currentArticle;

    /**
     * @var RestContext
     */
    protected $restContext;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }

    /**
     * @BeforeScenario
     */
    public function before(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $this->restContext = $environment->getContext(RestContext::class);
    }

    /**
     * Sends a HTTP request to create a new article as current resource used for the next features
     *
     * @Given I create a current article with body:
     */
    public function iCreateACurrentArticleWithBody(PyStringNode $body)
    {
        $response = $this->restContext->iSendARequestTo(
            Request::METHOD_POST,
            self::ARTICLE_RESOURCE_IRI,
            $body
        );
        $this->refreshCurrentArticle($response);

        return $response;
    }

    /**
     * Updates the current article
     *
     * @Given I update the current article with body:
     */
    public function iUpdateTheCurrentArticleWithBody(PyStringNode $body)
    {
        $response = $this->restContext->iSendARequestTo(
            Request::METHOD_PUT,
            self::$currentArticle['@id'],
            $body
        );
        $this->refreshCurrentArticle($response);

        return $response;
    }

    /**
     * Deletes the current Article
     *
     * @Given I delete the current article
     */
    public function iDeleteTheCurrentArticle()
    {
        $response = $this->restContext->iSendARequestTo(
            Request::METHOD_DELETE,
            self::$currentArticle['@id']
        );

        return $response;
    }

    /**
     * Gets the current article
     *
     * @Given I get the current article
     */
    public function iGetTheCurrentArticle()
    {
        return $this->restContext->iSendARequestTo(
            Request::METHOD_GET,
            self::$currentArticle['@id']
        );
    }

    private function refreshCurrentArticle(DocumentElement $response): void
    {
        $data = json_decode((string) $response->getContent(), true);

        if (array_key_exists('@id', $data)) {
            self::$currentArticle = $data;
        }
    }
}
