<?php

namespace Laraviet\DDDCore\Book\Domain\Entities;

use Illuminate\Validation\ValidationException;
use Laraviet\DDDCore\Book\Domain\Entities\ValidatorInterface;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;

class BaseLaravelValidator implements ValidatorInterface
{
    protected $rules;
    protected $factory;
    protected $validatesRequestErrorBag;

    public function __construct(\Illuminate\Contracts\Validation\Factory $factory)
    {
        $this->factory = $factory;
    }

    public function validate($request)
    {
        $validator = $this->factory->make($request->all(), $this->rules);
        if($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }

    private function throwValidationException(Request $request, $validator)
    {
        throw new ValidationException($validator, $this->buildFailedValidationResponse(
            $request, $this->formatValidationErrors($validator)
        ));
    }

    private function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->getMessages();
    }

    private function buildFailedValidationResponse(Request $request, array $errors)
    {
        if ($request->expectsJson()) {
            return new JsonResponse($errors, 422);
        }

        return redirect()->to($this->getRedirectUrl())
                        ->withInput($request->input())
                        ->withErrors($errors, $this->errorBag());
    }

    private function getRedirectUrl()
    {
        return app(UrlGenerator::class)->previous();
    }

    private function errorBag()
    {
        return $this->validatesRequestErrorBag ?: 'default';
    }
}