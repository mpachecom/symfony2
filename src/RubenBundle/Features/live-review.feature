Feature: Live Review
  In order to see if the live review works
  As a user
  I need to create a review, add negative and positive words and finally see the score

  Scenario: Main text
    Given I am on "/live-review/"
    Then I should see "Write your review and check if it's positive or not against your positive and negative words"

  Scenario: Score 0
    Given I am on "/live-review/"
    Then I fill in "review" with "hello marcos"
    When I press "checkReview"
    Then I should see "Score is 0 :-|"

  Scenario: Score -1
    Given I am on "/live-review/"
    Then I fill in "review" with "The hotel was horrible"
    Then I fill in "negative_words" with "horrible"
    When I press "checkReview"
    Then I should see "Score is -1 :-("

  Scenario: Score -2
    Given I am on "/live-review/"
    Then I fill in "review" with "The hotel was horrible and cold"
    Then I fill in "negative_words" with "horrible,cold"
    When I press "checkReview"
    Then I should see "Score is -2 :-("

  Scenario: Score 1
    Given I am on "/live-review/"
    Then I fill in "review" with "The hotel was awesome"
    Then I fill in "positive_words" with "awesome"
    When I press "checkReview"
    Then I should see "Score is 1 :-D"

  Scenario: Score 3
    Given I am on "/live-review/"
    Then I fill in "review" with "The hotel was awesome, cheap and lovely"
    Then I fill in "positive_words" with "awesome,cheap,lovely"
    When I press "checkReview"
    Then I should see "Score is 3 :-D"


  Scenario: Score -3
    Given I am on "/live-review/"
    Then I fill in "review" with "The hotel was horrible, very cold small and expensive, at least was in a nice place"
    Then I fill in "positive_words" with "nice"
    Then I fill in "negative_words" with "horrible,cold,small,expensive"
    When I press "checkReview"
    Then I should see "Score is -3 :-("


  Scenario: Reset
    Given I am on "/live-review/"
    Then I fill in "review" with "The hotel was horrible, very cold small and expensive, at least was in a nice place and the staff was friendly"
    Then I fill in "positive_words" with "nice,friendly"
    Then I fill in "negative_words" with "horrible,cold,small,expensive"
    When I press "checkReview"
    Then I should see "Score is -2 :-("
    And I press "resetReview"
    Then I should see "Write your review and check if it's positive or not against your positive and negative words"

