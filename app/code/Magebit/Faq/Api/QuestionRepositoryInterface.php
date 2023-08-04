<?php

declare(strict_types=1);

namespace Magebit\Faq\Api;

/**
 * Question repository interface
 *
 * @api
 */
interface QuestionRepositoryInterface
{
    /**
     * Save page.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Magebit\Faq\Api\Data\QuestionInterface $question): Data\QuestionInterface;

    /**
     * Retrieve page.
     *
     * @param int $questionId
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $questionId): Data\QuestionInterface;

    /**
     * Retrieve pages matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magebit\Faq\Api\Data\QuestionSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria): Data\QuestionSearchResultInterface;

    /**
     * Delete page.
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Magebit\Faq\Api\Data\QuestionInterface $question): bool;

    /**
     * Delete page by ID.
     *
     * @param int $questionId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $questionId): bool;
}
