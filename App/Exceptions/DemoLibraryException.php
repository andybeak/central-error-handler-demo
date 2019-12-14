<?php

namespace App\Exceptions;

use Exception;

class DemoLibraryException extends Exception
{
    /**
     * @var int
     */
    public $httpStatus;

    /**
     * @var string
     */
    public $errorId;

    /**
     * DemoLibraryException constructor.
     * @param string|null $message
     * @param int|null $httpStatus
     * @param int|null $code
     * @param Exception|null $previous
     * @throws Exception
     */
    public function __construct(
        string $message = null,
        int $httpStatus = null,
        string $errorId = null,
        $code = 0,
        Exception $previous = null
    ) {
        $this->httpStatus = $httpStatus;
        if (is_null($errorId)) {
            $this->errorId = date('ymd') . '-' . bin2hex(random_bytes(4));
        } else {
            $this->errorId = $errorId;
        }

        parent::__construct($message, $code, $previous);
    }

}