<?php

namespace Rlab\ShoppingClub\CustomerData;

use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class ShoppingClubData  implements SectionSourceInterface
{

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var GroupRepositoryInterface
     */
    protected $groupRepository;

    /**
     * ShoppingClubData constructor.
     * @param Session $customerSession
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(
        Session $customerSession,
        GroupRepositoryInterface $groupRepository
    ) {
        $this->customerSession = $customerSession;
        $this->groupRepository = $groupRepository;
    }


    /**
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getSectionData()
    {
        $checkGroup = $this->checkCustomerGroup();

        return [
            'isLoggedIn' => $this->customerSession->isLoggedIn(),
            'checkGroup' => $checkGroup

        ];
    }

    /**
     * @return bool|null
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function checkCustomerGroup()
    {
        $customerGroupId = $this->customerSession->getCustomer()->getGroupId();
        $group = $this->groupRepository->getById($customerGroupId);

        if ($group->getCode()!=="Shopping Club"){
            return true;
        }
            return null;
    }
}
