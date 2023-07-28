<?php

declare(strict_types=1);

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @api
 */
interface QuestionRepositoryInterface
{
    /**
     * Save question.
     *
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws LocalizedException
     */
    public function save(QuestionInterface $question): QuestionInterface;

    /**
     * Retrieve question.
     *
     * @param string $questionId
     * @return QuestionInterface
     * @throws LocalizedException
     */
    public function getById(string $questionId): QuestionInterface;

    /**
     * Retrieve questions matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultInterface;

    /**
     * Delete question.
     *
     * @param QuestionInterface $question
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(QuestionInterface $question): bool;

    /**
     * Delete question by ID.
     *
     * @param string $questionId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(string $questionId): bool;
}
