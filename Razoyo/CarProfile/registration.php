<?php
/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Created By: jason
 * 9/16/24
 */

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Razoyo_CarProfile',
    __DIR__
);