<?php

namespace ArticleHub\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Gedmo\Blameable\Traits\Blameable;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\Timestampable;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Uuid;

/**
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={
 *              "groups"={
 *                  "comment_normalized",
 *              },
 *              "enable_max_depth"=true
 *          },
 *          "denormalization_context"={
 *              "groups"={"comment_model"},
 *              "allow_extra_attributes"=false,
 *          },
 *     },
 *     collectionOperations={},
 *     itemOperations={
 *         "delete",
 *     }
 * )
 * @ORM\Table(name="ah_article_comment")
 * @ORM\Entity()
 *
 * @final
 */
class ArticleComment
{
    use Blameable;
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(max = 5000, maxMessage = "length.max,{{ limit }}")
     * @Assert\NotNull(message="not_null")
     * @Assert\NotBlank(allowNull=true, message="not_blank")
     * @Groups({
     *     "comment_model",
     *     "comment_normalized",
     * })
     */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="ArticleHub\Entity\Article", inversedBy="comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", nullable=false)
     * @MaxDepth(1)
     */
    protected $article;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="ArticleHub\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * @MaxDepth(1)
     */
    private $createdBy;

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
