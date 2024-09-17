<?php
/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Created By: jason
 * 9/16/24
 */

namespace Razoyo\CarProfile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Razoyo\CarProfile\Helper\Data; // Adjust this as per your helper's namespace
use Magento\Framework\Controller\ResultFactory; // This is the correct class

class Save extends Action
{
    protected $customerSession;
    protected $customerRepository;
    protected $carProfileHelper;
    protected $resultFactory;

    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        CustomerRepositoryInterface $customerRepository,
        Data $carProfileHelper,
        ResultFactory $resultFactory // Correctly reference ResultFactory here
    ) {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->carProfileHelper = $carProfileHelper;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = ['success' => false, 'message' => ''];
        // Check if the customer is logged in
        if (!$this->customerSession->isLoggedIn()) {
            $result['message'] = 'Please login your account!';
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
        }

        try {
            // Get customer and car ID from the form data
            $carId = $this->getRequest()->getParam('car_id');
            $customerId = $this->customerSession->getCustomer()->getId();

            // Update the car profile
            if ($customerId && $carId) {
                $customer = $this->customerRepository->getById($customerId);
                $customer->setCustomAttribute('car_profile', $carId);
                $this->customerRepository->save($customer);

                // Fetch the updated car information
                $carInfo = $this->carProfileHelper->getCarInfoById($carId);

                // Prepare the HTML to return
                $carInfoHtml = '<div class="car-info">
                    <img src="' . htmlspecialchars($carInfo['image']) . '"
                         alt="' . htmlspecialchars($carInfo['make'] . ' ' . $carInfo['model']) . '"
                         class="car-image"/>
                    <div class="car-details">
                        <h3>Car Information</h3>
                        <p><strong>Brand:</strong> ' . htmlspecialchars($carInfo['make']) . '</p>
                        <p><strong>Model:</strong> ' . htmlspecialchars($carInfo['model']) . '</p>
                        <p><strong>Year:</strong> ' . htmlspecialchars($carInfo['year']) . '</p>
                        <p><strong>Seats:</strong> ' . htmlspecialchars($carInfo['seats']) . '</p>
                        <p><strong>Mpg:</strong> ' . htmlspecialchars($carInfo['mpg']) . '</p>
                        <p><strong>Price:</strong> ' . htmlspecialchars('$' . $carInfo['price']) . '</p>
                    </div>
                </div>';


                $result['success'] = true;
                $result['message'] = 'Car profile saved successfully.';
                $result['carInfoHtml'] = $carInfoHtml;
            } else {
                $result['message'] = 'Car selection is invalid or missing.';
            }
        } catch (\Exception $e) {
            $result['message'] = 'An error occurred while saving the car profile.';
        }

        // Return the JSON response
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
