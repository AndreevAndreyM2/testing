<?php

namespace Rlab\ShoppingClub\Plugin;

class SetInGroupPlugin
{

    protected $_customerRepositoryInterface;

    protected $_customerSession;

    protected $_customerGroupFactory;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\ResourceModel\Group\CollectionFactory $customerGroupFactory

    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_customerSession = $customerSession;
        $this->_customerGroupFactory = $customerGroupFactory;
    }

    public function afterExecute(\Magento\Newsletter\Controller\Subscriber\Confirm $subject,  $result)
    {
       $group = $this->_customerGroupFactory->create();
       $group->addFieldToFilter('customer_group_code','Shopping Club');
       $groupId = $group->getFirstItem()->getData('customer_group_id');
       $customerId = $this->_customerSession->getCustomer()->getId();
        $customer = $this->_customerRepositoryInterface->getById($customerId);
       if ($customer->getGroupId() == 1) {
            $customer->setGroupId($groupId);
            $this->_customerRepositoryInterface->save($customer);
        }
        return $result;
    }
}








