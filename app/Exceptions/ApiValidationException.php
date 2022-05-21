<?php
namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Schema()
 */
class ApiValidationException extends ApiException
{
    /**
     * The err message
     * @var string
     * @OA\Property (
     *     type="object",
     *     property="message",
     *     @OA\Property(
     *         type="array",
     *         property="example",
     *         @OA\Items(
     *              type="string",
     *              example="The example field is required."
     *         )
     *     ),
     * )
     * @OA\Property (
     *     type="string",
     *     property="status",
     *     example="fail"
     * )
     */
    public function __construct(string|array $message = null)
    {
        parent::__construct(self::UNPROCESSABLE_ENTITY, $message ?: Response::$statusTexts[self::UNPROCESSABLE_ENTITY]);
    }
}
