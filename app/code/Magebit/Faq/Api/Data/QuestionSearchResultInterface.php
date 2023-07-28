<?php

declare(strict_types=1);

namespace Magebit\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for Question search results.
 * @api
 */
interface QuestionSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get Question list.
     *
     * @return QuestionInterface[]
     */
    public function getItems(): array;

    /**
     * Set Question list.
     *
     * @param QuestionInterface[] $items
     * @return QuestionSearchResultInterface
     */
    public function setItems(array $items): QuestionSearchResultInterface;
}
