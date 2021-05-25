<?php

namespace Rlab\ShoppingClub\Block\Account;

use Magento\Customer\Model\Context;
use Magento\Customer\Model\Registration;
use Magento\Customer\Model\Url;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Html\Link;


class RegisterLink extends Link
{

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Customer session
     *
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    /**
     * @var Registration
     */
    protected $registration;

    /**
     * @var Url
     */
    protected $customerUrl;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Registration $registration
     * @param Url $customerUrl
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        Registration $registration,
        Url $customerUrl,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->httpContext = $httpContext;
        $this->registration = $registration;
        $this->customerUrl = $customerUrl;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return  $this->urlBuilder->getUrl('shoppingclub/account/create');
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->registration->isAllowed()
            || $this->httpContext->getValue(Context::CONTEXT_AUTH)
        ) {
            return '';
        }
        return parent::_toHtml();
    }
}
