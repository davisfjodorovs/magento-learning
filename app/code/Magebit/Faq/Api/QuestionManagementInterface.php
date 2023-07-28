<?php

declare(strict_types=1);

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;

/**
 * @api
 */
interface QuestionManagementInterface
{
    /**
     * Enable a question
     *
     * @param QuestionInterface $question
     * @return bool true if successful
     */
    public function enableQuestion(QuestionInterface $question): bool;

    /**
     * Disable a question
     *
     * @param QuestionInterface $question
     * @return bool true if successful
     */
    public function disableQuestion(QuestionInterface $question): bool;
}
