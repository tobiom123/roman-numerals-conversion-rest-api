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

The project includes PHPUnit tests to ensure reliability and correctness of the API functionalities. I encourage you to run these tests via ``sail artisan test``
