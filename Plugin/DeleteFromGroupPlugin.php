<?php

namespace Rlab\ShoppingClub\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\State\InputMismatchException;
use Magento\Newsletter\Controller\Manage\Save;
use Psr\Log\LoggerInterface;

class DeleteFromGroupPlugin
{

    /**
     * @var LoggerInterface
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    protected $logger;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepositoryInterface;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var CollectionFactory
     */
    protected $customerGroupFactory;

    /**
     * DeleteFromGroupPlugin constructor.
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param Session $customerSession
     * @param CollectionFactory $customerGroupFactory
     * @param LoggerInterface $logger
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        Session $customerSession,
        CollectionFactory $customerGroupFactory,
        LoggerInterface $logger
    )
    {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->customerSession = $customerSession;
        $this->customerGroupFactory = $customerGroupFactory;
        $this->logger = $logger;
    }

    /**
     * @param Save $subject
     * @param $result
     * @return mixed
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     * @throws InputMismatchException
     */
    public function afterExecute(Save $subject, $result)
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        try {
            $customer = $this->customerRepositoryInterface->getById($customerId);
        } catch (NoSuchEntityException | LocalizedException $e) {
            $this->logger->critical($e->getMessage());
        }
        $customer->setGroupId(1);
        $this->customerRepositoryInterface->save($customer);

        return $result;
    }
}
