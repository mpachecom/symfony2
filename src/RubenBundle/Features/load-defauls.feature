Feature: Load defaults
  In order to see if we have load properly the default reviews
  As a user
  I need to see the data table properly

  Scenario: Check first review first hotel
    Given I am on "/load-default-reviews/"
    Then I should see "Found this hotel by reading over tripadvisor while planning a little beach getaway. Really good price by the beach. James the front desk manager was really fun, he made our stay more fun than we thought it would be. We are going to come back with our friends soon."

  Scenario: Check third review second hotel
    Given I am on "/load-default-reviews/"
    Then I should see "I have stayed here 4 or 5 times while visiting LA. Despite travelling all over the world and staying in some of the best international hotels ( for work), Hotel Caliornia is one of my absolute favourites. Perfect location, right on the beach. I love the way you can just open your door and be outside, no elevators, corridors big glass windows. The ambience is so nice, retro perfect. As for the staff, I have had consistently superb service, with much more personal service and attention to detail than is usual in bigger hotels. Aaron and Katy were just two who have been exemplary this time but really everyone is terrific. Can't recommend it highly enough."

  Scenario: Use dynamic search field
    Given I am on "/load-default-reviews/"
    Then I fill in "search-grid-field" with "otel by reading ove"
    Then I should see "was really fun, he made our stay more fun than "
    Then I should see "made our stay + 1"

  Scenario: Use dynamic search field no results
    Given I am on "/load-default-reviews/"
    Then I fill in "search-grid-field" with "rrrrrrrrrrrrrr"
    Then I should see "No matching records found"

  Scenario: Use dynamic review id field no results
    Given I am on "/load-default-reviews/"
    Then I fill in "search-field-Id" with "10"
    Then I should see "Showing 1 to 1 of 1 entries (filtered from 10 total entries)"

  Scenario: Use dynamic positive field no results
    Given I am on "/load-default-reviews/"
    Then I fill in "search-field-Positive" with "made our stay + 1"
    Then I should see "Showing 1 to 1 of 1 entries (filtered from 10 total entries)"

  Scenario: Use dynamic negative field no results
    Given I am on "/load-default-reviews/"
    Then I fill in "search-field-Negative" with "small - 1"
    Then I should see "Showing 1 to 3 of 3 entries (filtered from 10 total entries)"

  Scenario: Show 10 items
    Given I am on "/load-default-reviews/"
    Then I select "10" from "reviews-container_length"
    Then I should see "Showing 1 to 10 of 10 entries"

