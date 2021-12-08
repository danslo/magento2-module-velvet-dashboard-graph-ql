<?php

declare(strict_types=1);

namespace Danslo\VelvetDashboardGraphQl\Model\Resolver;

use Danslo\VelvetGraphQl\Api\AdminAuthorizationInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class Dashboard implements ResolverInterface, AdminAuthorizationInterface
{
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return [];
    }

    public function getResource(): string
    {
        return 'Magento_Backend::dashboard';
    }
}
