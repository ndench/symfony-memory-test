<?php

namespace App\Model;

class Progress
{
    /** @var string[] */
    private $previous;

    /** @var string */
    private $current;

    /** @var string[] */
    private $next;

    public function __construct(array $previous, string $current, array $next)
    {
        $this->previous = $previous;
        $this->current = $current;
        $this->next = $next;
    }

    /**
     * @return string[]
     */
    public function getPrevious(): array
    {
        return $this->previous;
    }

    /**
     * @return string
     */
    public function getCurrent(): string
    {
        return $this->current;
    }

    /**
     * @return string[]
     */
    public function getNext(): array
    {
        return $this->next;
    }
}
