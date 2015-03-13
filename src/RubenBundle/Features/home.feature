Feature: Home page
  In order to check the home page
  As a user
  I need to see the main texts

  Scenario: First link
    Given I am on "/"
    Then I should see "[Load default reviews & criteria]"

  Scenario: Second link
    Given I am on "/"
    Then I should see "[Load your own files and process them with PHP]"

  Scenario: Third link
    Given I am on "/"
    Then I should see "[Load your own files and process them with JS]"

  Scenario: Fourth link
    Given I am on "/"
    Then I should see "[Live review]"

  Scenario: main text
    Given I am on "/"
    Then I should see "↑↑↑ Please select one of the options. ↑↑↑"

