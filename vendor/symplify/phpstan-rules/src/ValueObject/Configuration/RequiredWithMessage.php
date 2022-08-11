<?php

declare(strict_types=1);

namespace Symplify\PHPStanRules\ValueObject\Configuration;

final class RequiredWithMessage
{
    /**
     * @var string
     */
    private $required;
    /**
     * @var string|null
     */
    private $message;
    public function __construct(string $required, ?string $message)
    {
        $this->required = $required;
        $this->message = $message;
    }

    public function getRequired(): string
    {
        return $this->required;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}