<?php
/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Created By: jason
 * 9/16/24
 */

namespace Razoyo\CarProfile\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_ENABLED = 'car_profile/general/enabled';
    const XML_PATH_API_PATH = 'car_profile/general/api_path';

    /**
     * Check if the Car Profile feature is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get the API Path from configuration
     *
     * @return string
     */
    public function getApiPath()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_PATH, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get all cars information from the API
     *
     * @return array
     */
    public function getAllCarsInfo()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->getApiPath(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['accept: application/json'],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new \Exception("cURL Error: " . $error);
        }

        $data = json_decode($response, true);

        // Check if data was fetched successfully
        if (isset($data['cars'])) {
            return $data['cars']; // Adjust based on the actual structure of the response
        }

        return [];
    }

    /**
     * Get car information by ID from the API
     *
     * @param string $carId
     * @return array|null
     */
    public function getCarInfoById($carId)
    {
        /*$curl = curl_init();
        $token="SFMyNTY.g2gDbQAAABY6OmZmZmY6MTY5LjI1NC4xNjkuMTI2bgYA3cboCpIBYgABUYA.6anxdSuXry6sSIS7t6of_87B1EEEIXVT3JlJkv8Ta4c";
        $url = $this->getApiPath() . '/' . $carId;

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['accept: application/json'],
            CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "Authorization: Bearer " . $token
        ],
            CURLOPT_SSL_VERIFYPEER => false, // For testing purposes; set to true in production
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            throw new \Exception("cURL Error: " . $error);
        }

        $data = json_decode($response, true);

        // Check if data was fetched successfully
        if (isset($data['car'])) {
            return $data['car']; // Adjust based on the actual structure of the response
        }

        return null;*/
        return array (
            'id' => 'abcdefghijklmnop',
            'year' => 2024,
            'make' => 'Ford',
            'model' => 'Focus',
            'price' => 11000.99,
            'seats' => 5,
            'mpg' => 30,
            'image' => 'https://static.cargurus.com/images/forsale/2024/08/25/17/49/2025_lexus_nx-pic-3794297662994790958-1024x768.jpeg',
        );

    }
}
