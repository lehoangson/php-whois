# Introduction
This package contains a Whois (RFC954) library for PHP. It allows a PHP program to create a Whois object, and obtain the output of a whois query with the lookup function.

The response is an array containing, at least, an element 'rawdata', containing the raw output from the whois request.

It fully supports IDNA (internationalized) domains names as defined in RFC3490, RFC3491, RFC3492 and RFC3454.

# Requirements
PHP whois requires PHP 5.3 or better with OpenSSL support to work properly.

Without SSL support you will not be able to query domains which do not have a whois server but that have a https based whois.

# Installation
Upload all files to you host and run it like: your-whois-url/?domain=test.com

# Credits
Peter Le: lehoangson@gmail.com

Company: Nhan Hoa Softwave Company Ltd

WHMCS whois functions: www.whmcs.com
