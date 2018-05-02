Feature: Homepage
	In order to make sure that the website is working
	As website visitor
	I should see the homepage and be able to follow what have in the homepage

	Background:
		Given I am in full screen
		And I am on the homepage
		Then I should see "TOTAL: $2.00"

	# This is just for payway testing but not yet complete steps
	@javascript
	Scenario: Checkout Payment
		When I press "Checkout Now"
		And I wait for "1" seconds
		When I switch to iframe "div.aba-modal-content iframe.aba-iframe" selector
		And I wait for "10" seconds
		Then I should see "Enter your personal information"
		Then I should see "Transaction Summary"
		And I fill in "ShippingFname" with "Sakona"
		And I fill in "ShippingLname" with "Chhoeurng"
		And I fill in "ShippingPhone" with "081399216"
		And I fill in "ShippingEmail" with "sakona.chhoeurng@gmail.com"
		When I press "shippingNext"
		And I wait for "5" seconds
		When I follow the "2" of selector "div.coverInternationalCard div.pOptionCode button.pay-option"
		And I wait for "3" seconds