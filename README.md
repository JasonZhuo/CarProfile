# Razoyo_CarProfile module
Razoyo_CarProfile module allows a customer to choose a from a pre-determined list of cars and save the selection to the customer profile.

## Installation details

The Razoyo_CarProfile module makes irreversible changes in a database during installation. You cannot disable or uninstall this module.

Download the Razoyo_CarProfile module package or clone it from the repository

Enabled: 

php bin/magento module:enable Razoyo_CarProfile

php bin/magento setup:upgrade

php bin/magento setup:di:compile

php bin/magento setup:static-content:deploy -f

php bin/magento cache:clean

Disabled:

php bin/magento module:disable Razoyo_CarProfile

cd /path/to/magento/app/code/Razoyo
sudo rm -rf CarProfile

php bin/magento setup:upgrade

php bin/magento setup:di:compile

php bin/magento setup:static-content:deploy -f

php bin/magento cache:clean


## Additional information

#1. Configurable Settings (check Screenshot)

Configure the Car Profile feature via the Magento Admin Panel:
Navigate to Admin → Stores → Configuration → Customers → Car Profile to enable and customize the functionality.

#2. AJAX Integration (check Screenshot)

Utilize AJAX to dynamically update the car information and status messages without reloading the page when users click the "Save" button. This enhances performance and user experience.

#3. Enhanced Security

Implement security measures by adding validation checks in the custom controller to ensure secure handling of posted data, reducing the risk of malicious input.

#4. Searchable Select Dropdown (check Screenshot)

Improve the customer experience by integrating a searchable select dropdown, allowing users to quickly find and select car models, making the interface more user-friendly.

#5 Unit Testing

Ensure code quality and reliability by writing unit tests for the module's core functionality, covering various use cases and error handling.

#6 Responsive Design (check Screenshot)

Design the user interface to be fully responsive, providing an optimal viewing experience across a wide range of devices, from desktop to mobile.

#7 CSP Whitelist

Add Content Security Policy (CSP) rules to allow the display of car images from external sources by whitelisting the appropriate domains for secure content loading.
