<?php

declare(strict_types=1);

namespace Danslo\VelvetDashboardGraphQl\Model\Resolver\Dashboard;

use Magento\Directory\Model\Currency;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Reports\Model\ResourceModel\Customer\CollectionFactory;

class CustomersNewest implements ResolverInterface
{
    private CollectionFactory $collectionFactory;
    private Currency $currency;

    public function __construct(CollectionFactory $collectionFactory, Currency $currency)
    {
        $this->collectionFactory = $collectionFactory;
        $this->currency = $currency;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $collection = $this->collectionFactory->create()
            ->addCustomerName()
            ->addOrdersStatistics()
            ->orderByCustomerRegistration()
            ->setPageSize(5);

        $customers = [];
        foreach ($collection as $customer) {
            $customers[] = [
                'customer_id' => $customer->getId(),
                'name' => $customer->getName(),
                'orders' => $customer->getOrdersCount() ?? 0,
                'average' => $this->currency->format($customer->getOrdersAvgAmount(), [], false),
                'total' => $this->currency->format($customer->getOrdersSumAmount(), [], false)
            ];
        }
        return $customers;
    }
}
