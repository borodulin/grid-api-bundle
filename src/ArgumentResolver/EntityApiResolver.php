<?php

declare(strict_types=1);

namespace Borodulin\GridApiBundle\ArgumentResolver;

use Borodulin\GridApiBundle\GridApi\EntityApi;
use Borodulin\GridApiBundle\GridApi\EntityApiInterface;
use Borodulin\GridApiBundle\GridApi\Expand\ExpandFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class EntityApiResolver implements ArgumentValueResolverInterface
{
    private NormalizerInterface $normalizer;
    private ExpandFactory $expandFactory;

    public function __construct(
        NormalizerInterface $normalizer,
        ExpandFactory $expandFactory
    ) {
        $this->normalizer = $normalizer;
        $this->expandFactory = $expandFactory;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $type = $argument->getType();

        if (!$type || !interface_exists($type)) {
            return false;
        }

        $reflection = new \ReflectionClass($type);

        return $reflection->isInterface()
            && $reflection->implementsInterface(EntityApiInterface::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $expand = $this->expandFactory->tryCreateFromInputBug($request->query);

        yield (new EntityApi($this->normalizer))
            ->setExpand($expand)
        ;
    }
}
