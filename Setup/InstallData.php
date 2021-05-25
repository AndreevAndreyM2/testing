<?php

namespace Rlab\ShoppingClub\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\GroupFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var GroupFactory
     */
    protected $groupFactory;

    /**
     * InstallData constructor.
     * @param GroupFactory $groupFactory
     */
    public function __construct(GroupFactory $groupFactory) {
        $this->groupFactory = $groupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Exception
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $group = $this->groupFactory->create();
        $group
            ->setCode('Shopping Club')
            ->setTaxClassId(3)
            ->save();

        $setup->endSetup();
    }
}
