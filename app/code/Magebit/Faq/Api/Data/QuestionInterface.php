<?php

declare(strict_types=1);

namespace Magebit\Faq\Api\Data;

/**
 * Question interface.
 *
 * @api
 */
interface QuestionInterface
{
    /**
     * Get ID.
     *
     * @return int|null
     */
    public function getId(): int|null;

    /**
     * Get question.
     *
     * @return string
     */
    public function getQuestion(): string;

    /**
     * Get answer.
     *
     * @return string
     */
    public function getAnswer(): string;

    /**
     * Get item status.
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Get item position.
     *
     * @return int
     */
    public function getPosition(): int;

    /**
     * Get update time.
     *
     * @return string
     */
    public function getUpdateTime(): string;

    /**
     * Set question.
     *
     * @return QuestionInterface
     */
    public function setQuestion(): QuestionInterface;

    /**
     * Set array of answers.
     *
     * @return QuestionInterface
     */
    public function setAnswer(): QuestionInterface;

    /**
     * Set item status.
     *
     * @return QuestionInterface
     */
    public function setStatus(): QuestionInterface;

    /**
     * Set item position.
     *
     * @return QuestionInterface
     */
    public function setPosition(): QuestionInterface;
}
