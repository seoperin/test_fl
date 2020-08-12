<?php

namespace App\Services\Dto;

final class InnResponseDto
{

    /**
     * @var bool
     */
    private $success;
    /**
     * @var string
     */
    private $message;
    /**
     * @var null
     */
    private $error_code;

    /**
     * InnResponseDto constructor.
     * @param bool $success
     * @param string $message
     * @param null $error_code
     */
    public function __construct(bool $success, string $message, $error_code = null)
    {
        $this->success = $success;
        $this->message = $message;
        $this->error_code = $error_code;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return null
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }


}
