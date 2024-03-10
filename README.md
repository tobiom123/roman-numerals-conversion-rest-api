# Roman Numerals API Project README

## Overview

The Roman Numerals API project is designed to offer a simple yet effective solution for converting integers into their Roman numeral representations. 
This project is built to fulfil the requirements of our client, Numeral McNumberFace, via a RESTful API architecture for ease of use and integration. The API provides a straightforward interface for converting integers, tracking conversion frequencies, and retrieving conversion history.

### Key Features

- **Integer to Roman Numeral Conversion:** Converts integers between 1 and 3999 to Roman numerals.
- **Conversion Tracking:** Records each conversion to track the most frequently converted integers and the latest conversion times.
- **Endpoints:**
    1. **Convert Integer:** Accepts an integer (includes validation), converts it to a Roman numeral, stores the conversion, and returns the result.
    2. **Recent (all) Conversions:** Lists all recently converted integers.
    3. **Top Conversions:** Lists the top 10 most frequently converted integers.

## Development Focus

This project prioritises clean, maintainable code and efficient functionality, with an emphasis on:

- **MVC Architecture:** Utilising Model-View-Controller components for organised code structure. The "View" component is represented by Laravel Resources for API responses.
- **Laravel Ecosystem:** Leveraging Laravel features such as Eloquent for ORM, Requests for data validation, and Routes for API endpoint definition.
- **Clean Code Practices:** Adhering to PSR-12 standards for code style and utilising PHP 8.0+ features to enhance readability and performance.

## Testing

The project includes PHPUnit tests to ensure reliability and correctness of the API functionalities. I encourage you to run these tests via ``./vendor/bin/sail artisan test``

## Getting Started

## Prerequisites

Before proceeding, make sure you have the following software installed on your machine:

1. **Git**: Version control system for cloning the repository.
2. **Docker**: Containerization platform for running the Laravel Sail environment.
3. PHP ^8.1
4. Composer

## Step 1: Clone the Repository

Open your terminal and clone the two repository for the REST API.

```bash
# Clone the Laravel Sail REST API repo
git clone path/to/tobiomotosho.bundle roman-numerals-api
```

## Step 2: Set up the Laravel Sail REST API

1. Change into the REST API directory.

```bash
cd roman-numerals-api
```

2. Install dependencies and set up the environment.

```bash
# Copy the example environment file and update it with your configuration
cp .env.example .env

# Install PHP dependencies
composer install
composer update
```

3. Run the Laravel Sail environment using Docker.

```bash
./vendor/bin/sail up

# Generate the application key
./vendor/bin/sail artisan key:generate

# Install PHP dependencies within container
./vendor/bin/sail composer install

# Create the database tables
./vendor/bin/sail artisan migrate

# Create the database tables and seed with demo data (Optional)
./vendor/bin/sail artisan migrate --seed
```
**If** you experience "connection refused", obtain Docker Network Bridge IPAM Gateway IP
```
docker network inspect bridge
{
"IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": [
                {
                    "Subnet": "172.17.0.0/16",
                    "**Gateway**": "172.17.0.1"
                }
            ]
        },
}
```
Then replace assign the Gateway IP to DB_HOST within your .env

The REST API should now be running and accessible at `http://localhost:80` or `http://localhost:8000`.
