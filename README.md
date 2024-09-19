Magento2 Custom module -- Car Profile

Description:
Module called Razoyo_CarProfile that allows a customer to choose a from a pre-determined list of cars and save the selection to the customer profile.

Requirements:

1.The module must work on the latest supported Magento 2 version.
2.You must include screenshots that showcase your module in your Github repository.
3.Add a new account menu item to the customer dashboard called "My Car Profile".
4.Build a form that allows the user to select a car from the listCars API.
5.When the user saves the form, it should save thier car selection to their customer profile.
6.If the customer has a car saved, it should render an image of the car and some basic information about it in the "My Car Profile" tab.
7.The customer should be able to change their car at any time.

API resoure:
https://editor.swagger.io/?url=https%3A%2F%2Fstorage.googleapis.com%2Frazoyo-exam-spec%2Fcars.yaml%3Fv%3D22.05.06

Thanks for Rrazoyo creating this exam for the magento developer. 
https://exam.razoyo.com/magento


Features:

1.Set the configuration at Admin → Stores → Configuration → Customers → Car Profile.
2.Use Ajax to update the message and car information after clicking the "Save" button.
3.Add security checks when posting data to the custom controller method.
4.Use a searchable select dropdown to enhance the customer shopping experience.
5.Write unit tests for the code.
6.Make the design responsive.
7.Add the CSP whitelist for car images.

Notice:
There is an issue with the API when finding a car by ID with the token, resulting in a 403 error.
