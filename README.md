# Epitrove Helper Addon

This helper addon provides an interface in customer's WordPress website dashboard to manage licenses and updates
of products purchased from [epitrove.com](https://epitrove.com).

## For Vendors/EpiSellers:
If you're an EpiSeller, you can use following methods provided by this helper addon in the code for various purposes:

### Read License Key
To read a license key entered by customer for your product, you can use `\Licensing\EpitroveLicense::licenseKey(<NAME-OF-THE-FOLDER>)`.

For example, if name of your plugin or theme's folder is `hello`, then your function call would look like `\Licensing\EpitroveLicense::licenseKey('hello')`

In order to avoid throwing fatal error when Epitrove Helper addon is not available or installed, you should write code like this

`$licenseKey = method_exists('\Licensing\EpitroveLicense','licenseKey') ? \Licensing\EpitroveLicense::licenseKey('hello') : '';`

### Check License Status
To check the license status, you can use `\Licensing\EpitroveLicense::isActive(<NAME-OF-THE-FOLDER>)`.

This method returns `true`, if customer has entered license key on 
'Epitrove Licensing' Page in their website's dashboard for your product and that license key is active.

Similar to above example, correct way of checking this will be

`$isActiveLicense = method_exists('\Licensing\EpitroveLicense','isActive') ? \Licensing\EpitroveLicense::isActive('hello') : false;`