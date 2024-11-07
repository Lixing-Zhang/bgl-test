## Setup

docker compose run app composer install
`
## Run application
`
docker compose run app

## Run test

docker compose run test

## Here's an outline for approaching this task:

### Assumptions
- **Subscription Models**: There are two types of subscriptions: monthly
  and annually.
- **Billing Period**: The service will generate a new bill at the end of
  each subscription period (monthly or annually).
- **Currency**: The service assumes all billing is done in USD for
  simplicity.
- **Pricing**: Pricing for monthly and annual plans will be fixed and
  passed as parameters or set as constants.
- **CLI Execution**: The code should be executable from the command line,
  allowing input for different customers and subscription periods.
- Data Storage: Database interactions are not needed; mock data will be
  used.

### Design Decisions

- **Object-Oriented Design**: The service will use an OOP approach with
  classes for Subscription, Customer, and BillingService.
- **Separation of Concerns**: The design will ensure that each class has a
  single responsibility (e.g., BillingService will handle billing,
  Product will manage subscription data).
- **Flexibility for Pricing**: Pricing information will be set in the
  Product class as constants.
- **Test Cases**: Basic test cases will be included to demonstrate the
  service's functionality.
### Clean Code Principles
- **Readability**: Use clear, descriptive class and method names.
- **Simplicity**: Keep methods short and ensure that they perform only one
  task.
- **Consistency**: Maintain consistent naming conventions and code
  structure.
- **Error Handling**: Include basic error handling to validate input data
  and handle edge cases.
