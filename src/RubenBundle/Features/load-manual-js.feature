Feature: Load manual JS
  In order to see if we can upload csv and process them with JS
  As a user
  I need to see the final grid

  Scenario: JS main page
    Given I am on "/load-manual-js/"
    Then I should see "load reviews"
    Then I should see "load criteria"

  Scenario: Upload criteria and reviews
    Given I am on "/load-manual-js/"
    When attach the file "/criteria.csv" to "criteria"
    And attach the file "/reviews.csv" to "reviews"
    Then I should see "Found this hotel by reading over tripadvisor"

  Scenario: Upload reviews first, an error message will appear, we need first the criteria file
    Given I am on "/load-manual-js/"
    When attach the file "/reviews.csv" to "reviews"
    Then I should see "Please load first the criteria file"

