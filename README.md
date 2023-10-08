# wp-payu-integration

# Introduction
This article explains how PayU payment gateway (payu.in) can be integrated into a WordPress website. There are two major steps required for an integration:

1. Add a folder with required files to the WordPress website
2. Configure the redirect url with desired parameters

# Add a folder with required files to the WordPress website
This is a one-time setup which needs to be done to a WordPress website which needs to support PayU payment integration. 
1. Clone the `main` branch this [GitHub repository](https://github.com/MFactor-Consultancy/wp-payu-integration) on your local machine
2. Upload the `payu-gateway` folder in the root of the WordPress website

# Configure environment settings
1. Copy the `environments.sample.json` file and name the copy as `environments.json`
2. Add different environments settings in the json file by following the sample json provided

# Configure the redirect url with desired parameters
To initiate redirect to PayU payment page first you need to generate the payment url. The payment url has the following format:

`{website-scheme}://{website-host}/payu-gateway/?merchant={merchant}&amount={amount}&firstname={first-name}&lastname={last-name}&email={email}&phone={phone}&country={country}&state={state}&city={city}&zipcode={zipcode}&address1={address1}&address2={address2}&productinfo={product-info}&udf1={udf1}&udf2={udf2}&udf3={udf3}&udf4={udf4}&udf5={udf5}&surl={success-url}&furl={failure-url}`

## Parameters
All of the parameters are required:

- `{website-scheme}` (required *) - either "http" or "https"
- `{website-host}` (required *) - the domain to which the website is hosted (example: example.org)
- `{merchant}` (required *) - the key of the merchant configuration from the `environments.json` file
- `{amount}` (required *) - the payment amount
- `{product-info}` (required *) - the payment amount
- `{first-name}` (required *) - customer first name
- `{email}` (required *) - customer email address
- `{phone}` (required *) - customer phone number
- `{success-url}` (required *) - the user will be redirected to this url on successful payment.
- `{failure-url}` (required *) - the user will be redirected to this url on failed payment.
- `{last-name}` (optional) - customer last name
- `{country}` (optional) - customer country
- `{state}` (optional) - customer state
- `{city}` (optional) - customer city
- `{zipcode}` (optional) - customer zipcode
- `{address1}` (optional) - customer addressline1
- `{address2}` (optional) - customer addressline2
- `{udf1}` (optional) - additional user-defined field 1
- `{udf2}` (optional) - additional user-defined field 2
- `{udf3}` (optional) - additional user-defined field 3
- `{udf4}` (optional) - additional user-defined field 4
- `{udf5}` (optional) - additional user-defined field 5

## Example Urls
**All parameters**

<https://mohanjicentres.org/payu-gateway/?merchant=mf&amount=100&firstname=John&lastname=Doe&email=john@doe.com&phone=+1234567890&country=India&state=KL&city=Kochi&zipcode=123456&address1=AddressLine1&address2=AddressLine2&productinfo=DonationFromWebsite&uef1=udf1&udf2=udf2&udf3=udf3&udf4=udf4&udf5=udf5&surl=https://mohanjicentres.org/donation-successful&furl=https://mohanjicentres.org/donation-failed/>

**Only required parameters**

<https://mohanjicentres.org/payu-gateway/?merchant=mf&amount=100&firstname=John&email=john@doe.com&phone=+1234567890&productinfo=DonationFromWebsite&surl=https://mohanjicentres.org/donation-successful&furl=https://mohanjicentres.org/donation-failed/>
