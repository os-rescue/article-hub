<?php

namespace ArticleHub\EventListener\Article;

use Eqsgroup\Entity\Article;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RequestMessageContentSanitizerEntityListener implements EventSubscriber
{
    private const PARAMETER_NAME_ALLOWABLE_TAGS = 'article_allowed_content_html_tags';

    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preFlush,
        ];
    }

    public function preFlush(RequestMessage $requestMessage)
    {
        $this->sanitizeContent($requestMessage);
    }

    private function sanitizeContent(RequestMessage $requestMessage)
    {
        $sanitizedContent = strip_tags($requestMessage->getMessage(), implode(' ', $this->getAllowableTags()));
        $requestMessage->setMessage($sanitizedContent);
    }

    private function getAllowableTags(): array
    {
        if (!$this->parameterBag->has(self::PARAMETER_NAME_ALLOWABLE_TAGS)) {
            return [];
        }

        return $this->parameterBag->get(self::PARAMETER_NAME_ALLOWABLE_TAGS);
    }
}
