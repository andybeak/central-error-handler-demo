<?php

namespace App;

use App\Exceptions\DemoLibraryException;
use App\Exceptions\SpecificException;
use Psr\Log\LoggerInterface;

class ExampleClass
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param int $min
     * @throws SpecificException
     */
    public function validateMinimum(int $min)
    {
        if ($min < 0) {
            throw new SpecificException("The minimum value cannot be less than zero", 422);
        }
    }

    /**
     * @param int $min
     * @throws DemoLibraryException
     */
    public function exampleMethod(int $min)
    {
        try {

            $this->validateMinimum($min);

        } catch (SpecificException $e) {

            $context = [
                'min' => $min,
                'errorId' => $e->errorId,
                'memory_usage' => memory_get_usage(true)
            ];

            $this->logger->error($e->getMessage(), $context);

            throw new DemoLibraryException($e->getMessage(), $e->httpStatus, $e->errorId, $e->getCode(), $e);

        }
    }

    /**
     * @param LoggerInterface $logger
     * @return ExampleClass
     */
    public function setLogger(LoggerInterface $logger): ExampleClass
    {
        $this->logger = $logger;

        return $this;
    }
}