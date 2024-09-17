<?php
/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Created By: jason
 * 9/16/24
 */

namespace Razoyo\CarProfile\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Razoyo\CarProfile\Helper\Data;

class CarProfile extends Template
{
    protected $_customerSessionFactory;

    protected $customerRepository;
    protected $dataHelper;

    public function __construct(
        Template\Context $context,
        \Magento\Customer\Model\SessionFactory $customerSessionFactory,
        CustomerRepositoryInterface $customerRepository,
        Data $dataHelper,
        array $data = []
    ) {
        $this->_customerSessionFactory = $customerSessionFactory;
        $this->customerRepository = $customerRepository;
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }

    /**
     * Get customer data from session
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    public function getCustomer()
    {
        $customer = $this->_customerSessionFactory->create();
        return  $customer->getCustomer();
    }

    /**
     * Get the car profile of the logged-in customer
     *
     * @return string|null
     */
    public function getCarProfile()
    {
        $customer = $this->getCustomer();
        if ($customer) {
            return $customer->getData('car_profile');
        }
        return null;
    }

    public function getSaveUrl()
    {
        return $this->getUrl('carprofile/index/save');
    }

    public function getCarsList()
    {
        return $this->dataHelper->getAllCarsInfo();
    }

    public function getCarInfoById($carId)
    {
        return $this->dataHelper->getCarInfoById($carId);
    }
}
