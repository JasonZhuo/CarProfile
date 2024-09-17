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
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends Action
{
    protected $customerSession;
    protected $redirectFactory;

    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        RedirectFactory $redirectFactory
    ) {
        $this->customerSession = $customerSession;
        $this->redirectFactory = $redirectFactory;
        parent::__construct($context);
    }
    public function execute() {
        // Check if the customer is logged in
        if (!$this->customerSession->isLoggedIn()) {
            // Redirect to the custom login page if not logged in
            $resultRedirect = $this->redirectFactory->create();
            $resultRedirect->setPath('customer/account/login'); // Default Magento login page

            // If you have a custom login URL, you can modify this path:
            return $resultRedirect;
        }

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}