# Environnements

[Back to summary](index.md)

There are several different environments :

- `dev`: development environment
- `test`: test environment

The .env file defines the default values of the env vars needed by the application. and the .env.test file defines the default values of the test env vars for all machines.

## Overriding environment values

For each environment, it will be necessary to create a local file containing the required environment variables (e.g. to define new values on your local machine).

- `.env.local` : overrides the default values for all environments but only on the machine which contains the file. It's ignored in the test environment (because tests should produce the same results for everyone);
- `.env.test.local` : It's similar to .env.local, but the overrides only apply to test environment.

## Environment values required

- `DATABASE_URL` # To run the database, in dev and test environment, we use mysql.
- `MAILER_DSN` # To send emails, in dev and test environment, we use mailtrap, a testing tool.
