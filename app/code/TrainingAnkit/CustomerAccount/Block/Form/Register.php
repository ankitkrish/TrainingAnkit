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

use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\Context;
use Magento\Customer\Model\Registration;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url;
use Magento\Directory\Helper\Data;
use Magento\Directory\Model\ResourceModel\Country\CollectionFactory;
use Magento\Framework\App\Cache\Type\Config;
use Magento\Framework\DataObject;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Module\Manager;

/**
 * Class Register
 * @package TrainingAnkit\CustomerAccount\Block\Form
 */
class Register extends \Magento\Directory\Block\Data
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Manager
     */
    protected $moduleManager;

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
     * @var EncoderInterface
     */
    private $jsonEncoder;
    /**
     * @var Config
     */
    private $configCacheType;
    /**
     * @var \Magento\Directory\Model\ResourceModel\Region\CollectionFactory
     */
    private $regionCollectionFactory;
    /**
     * @var CollectionFactory
     */
    private $countryCollectionFactory;
    /**
     * @var Url
     */
    private $customerUrl;
    /**
     * @var array
     */
    private $data;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param Data $directoryHelper
     * @param EncoderInterface $jsonEncoder
     * @param Config $configCacheType
     * @param \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory
     * @param CollectionFactory $countryCollectionFactory
     * @param Manager $moduleManager
     * @param Session $customerSession
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param Registration $registration
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Data $directoryHelper,
        EncoderInterface $jsonEncoder,
        Config $configCacheType,
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory,
        CollectionFactory $countryCollectionFactory,
        Manager $moduleManager,
        Session $customerSession,
        Url $customerUrl,
        \Magento\Framework\App\Http\Context $httpContext,
        Registration $registration,
        array $data = []
    ) {
        $this->moduleManager = $moduleManager;
        $this->customerSession = $customerSession;
        $this->httpContext = $httpContext;
        $this->registration = $registration;
        parent::__construct(
            $context,
            $directoryHelper,
            $jsonEncoder,
            $configCacheType,
            $regionCollectionFactory,
            $countryCollectionFactory,
            $data
        );
        $this->context = $context;
        $this->directoryHelper = $directoryHelper;
        $this->jsonEncoder = $jsonEncoder;
        $this->configCacheType = $configCacheType;
        $this->regionCollectionFactory = $regionCollectionFactory;
        $this->countryCollectionFactory = $countryCollectionFactory;
        $this->customerUrl = $customerUrl;
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
     * Retrieve the form posting URL
     *
     * @return string
     */
    public function getPostActionUrl()
    {
        return $this->getUrl('trainingankit/customer_ajax/register');
    }

    /**
     * Retrieve back URL
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('customer/account/login');
    }

    /**
     * Retrieve form data
     *
     * @return mixed
     */
    public function getFormData()
    {
        $data = $this->getData('form_data');
        if ($data === null) {
            $formData = $this->customerSession->getCustomerFormData(true);
            $data = new DataObject();
            if ($formData) {
                $data->addData($formData);
                $data->setCustomerData(1);
            }
            if (isset($data['region_id'])) {
                $data['region_id'] = (int)$data['region_id'];
            }
            $this->setData('form_data', $data);
        }
        return $data;
    }

    /**
     * Newsletter module availability
     *
     * @return bool
     */
    public function isNewsletterEnabled()
    {
        return $this->moduleManager->isOutputEnabled('Magento_Newsletter');
    }

    /**
     * Get minimum password length
     *
     * @return string
     */
    public function getMinimumPasswordLength()
    {
        return $this->_scopeConfig->getValue(AccountManagement::XML_PATH_MINIMUM_PASSWORD_LENGTH);
    }

    /**
     * Get number of password required character classes
     *
     * @return string
     */
    public function getRequiredCharacterClassesNumber()
    {
        return $this->_scopeConfig->getValue(AccountManagement::XML_PATH_REQUIRED_CHARACTER_CLASSES_NUMBER);
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
}
