<?php
/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Created By: jason
 * 9/16/24
 */

namespace Razoyo\CarProfile\Test\Unit\Helper;

use PHPUnit\Framework\TestCase;
use Razoyo\CarProfile\Helper\Data;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\MockObject\MockObject;

class DataTest extends TestCase
{
    /**
     * @var Data
     */
    protected $dataHelper;

    /**
     * @var MockObject
     */
    protected $contextMock;

    /**
     * @var MockObject
     */
    protected $scopeConfigMock;

    protected function setUp(): void
    {
        // Mock the ScopeConfigInterface object
        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);

        // Mock the Context object and inject the scopeConfigMock into it
        $this->contextMock = $this->createMock(Context::class);
        $this->contextMock->method('getScopeConfig')->willReturn($this->scopeConfigMock);

        // Pass the mocked context to the Data helper constructor
        $this->dataHelper = new Data($this->contextMock);
    }

    public function testGetAllCarsInfo()
    {
        // Mock the getValue() method to return a valid API path
        $this->scopeConfigMock->method('getValue')
            ->with('car_profile/general/api_path', ScopeInterface::SCOPE_STORE)
            ->willReturn('https://exam.razoyo.com/api/cars');

        // Now, you can test getAllCarsInfo() or any method that depends on getApiPath()
        $carsList = $this->dataHelper->getAllCarsInfo();

        $this->assertIsArray($carsList);
        $this->assertEquals('Civic', $carsList[0]['model']);
    }
}
