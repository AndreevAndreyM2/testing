<?php
namespace Rlab\ShoppingClub\ViewModel;
class Data implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $sessionFactory;

    protected $customerGroupCollection;

    public function __construct(
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \Magento\Customer\Model\Group $customerGroupCollection
    ) {
        $this->sessionFactory = $sessionFactory;
        $this->customerGroupCollection = $customerGroupCollection;
    }

    public function isLoggedIn()
    {
        $user = $this->sessionFactory->create();
        return $user->isLoggedIn();
    }

    public function getCustomerGroup()
    {
        $session = $this->sessionFactory->create();

            $customerGroup = $session->getCustomer()->getGroupId();
            $groupCollection = $this->customerGroupCollection->load($customerGroup);
             return $groupCollection->getCustomerGroupCode();

        }



}
