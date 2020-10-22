<?php

namespace ArticleHub\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
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
 *                  "item_article_normalized",
 *                  "collection_articles_normalized",
 *              },
 *              "enable_max_depth"=true
 *          },
 *          "denormalization_context"={
 *              "groups"={"article_model"},
 *              "allow_extra_attributes"=false,
 *          },
 *     },
 *     collectionOperations={
 *          "get"={
 *              "pagination_client_items_per_page"=true,
 *              "normalization_context"={"groups"={"collection_articles_normalized"}}
 *          },
 *          "post",
 *      },
 *     itemOperations={
 *         "get"={"normalization_context"={"groups"={"item_article_normalized"}}},
 *         "put"={"security_post_denormalize"="is_granted('can_handle_article', object)"}
 *     }
 * )
 * @ORM\Table(name="ah_article")
 * @ORM\Entity()
 *
 * @final
 */
class Article
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
     * @ORM\Column(name="email", type="string", length=180)
     * @Assert\NotNull(message="not_null")
     * @Assert\NotBlank(allowNull=true, message="not_blank")
     * @Groups({
     *     "item_article_normalized",
     *     "article_model",
     * })
     */
    protected $title;

    /**
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(max = 3000000, maxMessage = "length.max,{{ limit }}")
     * @Assert\NotNull(message="not_null")
     * @Assert\NotBlank(allowNull=true, message="not_blank")
     * @Groups({
     *     "article_model",
     *     "item_article_normalized",
     *     "collection_articles_normalized",
     * })
     */
    protected $content;

    /**
     * @ORM\OneToMany(
     *     targetEntity="ArticleHub\Entity\ArticleComment",
     *     mappedBy="article",
     *     cascade={"remove"}
     * )
     * @ApiProperty(attributes={"fetchEager": false})
     * @ApiSubresource(maxDepth=1)
     */
    protected $comments;

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
     * @ORM\ManyToOne(targetEntity="ArticleHub\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     * @MaxDepth(1)
     */
    private $createdBy;

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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
}
