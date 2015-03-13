Feature: Load manual php
  In order to see if we can upload csv and process them with PHP
  As a user
  I need to see the final grid

  Scenario: PHP main page
    Given I am on "/load-manual-php/"
    Then I should see "Criteria"
    Then I should see "Reviews"
    Then I should see "Do it with ajax"

  Scenario: Upload reviews and criteria
    Given I am on "/load-manual-php/"
    When attach the file "/criteria.csv" to "form_criteria"
    And attach the file "/reviews.csv" to "form_reviews"
    And I press "form_save"
    Then I should see "Found this hotel by reading over tripadvisor"

  Scenario: Upload reviews and criteria and process them with Ajax
    Given I am on "/load-manual-php/"
    When attach the file "/criteria.csv" to "form_criteria"
    And attach the file "/reviews.csv" to "form_reviews"
    And I press "form_save"
    Then I should see "Found this hotel by reading over tripadvisor"
