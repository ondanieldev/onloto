# Onloto

## Introduction

System to improve chances to win in 'Lotofácil'.

## External Technologies

This system integrates with 'Upnid' to detects new buys to automate user register.

## Setting up credentials

As this app does not use environment variables (because the headache called php), you need to input your credentials inside the code. To do this, you just need to input values on some variables following the table below:

| archive         | variable     | description                              |
| --------------- | ------------ | ---------------------------------------- |
| connection.php  | $server      | The server where your database is placed |
| connection.php  | $user        | You database user                        |
| connection.php  | $pass        | The password of your database user       |
| connection.php  | $db          | Your database name                       |
| integration.php | $onlotoName  | The name of your application             |
| integration.php | $onlotoEmail | Your email                               |
| integration.php | $onlotoURL   | The URL of your application              |
| integration.php | $upnidToken  | Your upnid token                         |

## Setting up admin

This application has some admin functions. To access them, you need to log in with the admin user. By default, the admin user is the one that has id 1. So you also need to create a user with id 1. You can use whatever email and password you want, but the id must be 1.

## Testing the platform

To test the platform, visit [Onloto](http://romeno.onloto.com.br) and use admin@admin.com with the very secret password '123456'. Please, do not change the password.
