<?php

declare(strict_types=1);

namespace Magebit\Faq\Api\Data;

/**
 * Interface for Collection search results.
 *
 * @api
 */
interface QuestionSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get question list.
     *
     * @return \Magebit\Faq\Api\Data\QuestionInterface[]
     */
    public function getItems(): array;

    /**
     * Set Collection list.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface[] $items
     * @return \Magebit\Faq\Api\Data\QuestionSearchResultInterface
     */
    public function setItems(array $items): QuestionSearchResultInterface;
}
