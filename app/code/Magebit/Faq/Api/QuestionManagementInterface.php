<?php

declare(strict_types=1);

namespace Magebit\Faq\Api;

/**
 * Question management interface
 *
 * @api
 */
interface QuestionManagementInterface
{
    /**
     * Enable a question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\Questioninterface
     */
    public function enableQuestion(\Magebit\Faq\Api\Data\QuestionInterface $question): Data\QuestionInterface;

    /**
     * Disable a question
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\Questioninterface
     */
    public function disableQuestion(\Magebit\Faq\Api\Data\QuestionInterface $question): Data\QuestionInterface;
}
