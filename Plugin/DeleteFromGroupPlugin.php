<?php

namespace Rlab\ShoppingClub\Plugin;

class DeleteFromGroupPlugin
{

    protected $customerRepositoryInterface;

    protected $customerSession;

    protected $customerGroupFactory;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\ResourceModel\Group\CollectionFactory $customerGroupFactory

    ) {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->customerGroupFactory = $customerGroupFactory;
    }

    public function afterExecute(\Magento\Newsletter\Controller\Manage\Save $subject,  $result)
    {

        $customerId = $this->customerSession->getCustomer()->getId();
        $customer = $this->customerRepositoryInterface->getById($customerId);
            $customer->setGroupId(1);
            $this->customerRepositoryInterface->save($customer);

        return $result;
    }
}
