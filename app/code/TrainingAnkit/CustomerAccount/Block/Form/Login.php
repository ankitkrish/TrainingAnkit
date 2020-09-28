<?php

/**
 * TrainingAnkit
 * Copyright (C) 2019 TrainingAnkit <info@training.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    TrainingAnkit
 * @package     TrainingAnkit_CustomerAccount
 * @copyright   Copyright (c) 2012 Training (http://www.training.com/)
 * @license     http://www.TrainingAnkit.com/license-agreement.html
 * @author      Training <info@training.com>
 */

namespace TrainingAnkit\CustomerAccount\Block\Form;

use Magento\Customer\Model\Context;
use Magento\Customer\Model\Form;
use Magento\Customer\Model\Registration;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class Login extends Template
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;

    /**
     * Registration
     *
     * @var Registration
     */
    protected $registration;

    /**
     * @var \Magento\Framework\View\Element\Template\Context
     */
    private $context;

    /**
     * @var array
     */
    private $data;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param Session $customerSession
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Registration $registration
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Session $customerSession,
        \Magento\Framework\App\Http\Context $httpContext,
        Registration $registration,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->httpContext = $httpContext;
        $this->registration = $registration;
        $this->context = $context;
        $this->data = $data;
    }

    /**
     * Return registration
     *
     * @return Registration
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * Retrieve form posting url
     *
     * @return string
     */
    public function getPostActionUrl()
    {
        return $this->getUrl('customer/Ajax/login');
    }

    /**
     * Check if autocomplete is disabled on storefront
     *
     * @return bool
     */
    public function isAutocompleteDisabled()
    {
        return (bool)!$this->_scopeConfig->getValue(
            Form::XML_PATH_ENABLE_AUTOCOMPLETE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Checking customer login status
     *
     * @return bool
     */
    public function customerIsAlreadyLoggedIn()
    {
        return (bool)$this->httpContext->getValue(Context::CONTEXT_AUTH);
    }

    /**
     * Retrieve registering URL
     *
     * @return string
     */
    public function getCustomerRegistrationUrl()
    {
        return $this->getUrl('customer/account/create');
    }
}
