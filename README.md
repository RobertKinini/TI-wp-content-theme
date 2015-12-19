# TI-wp-content-theme
Wordpress theme for [content.tunapanda.org](http://content.tunapanda.org/).

## How's it going?

* [Issue tracking](https://waffle.io/tunapanda/TI-wp-content-theme/)
* [Metrics](https://www.dasheroo.com/reports/72a578b4d3decfa97208b6bbdd995578/public)

## Setting up a local environment for hacking

In order to participate in the developemnt, you need to have the following thigs set up on your computer:

 * Wordpress (This implies a webserver, e.g. Apache, and a database server, e.g. MySql).
 * NodeJS and NPM.
 * Grunt (install with `npm install -g grunt grunt-cli`)

Then, clone this repository and put it in your Wordpress themes folder. If you prefer, you can clone it to somewhere else on your local machine as symlink it from the themes folder. 

Important: After you clone and install the theme on your machine, you will need to activate it and this is how;
- Go to Apperance, point to theme and click.
 

- <img src="https://raw.githubusercontent.com/tunapanda/TI-wp-content-theme/master/theme_lead.png"> 
-

- Locate content_tunapanda_org theme and click on Activate.


-<img src="https://raw.githubusercontent.com/tunapanda/TI-wp-content-theme/master/activate_lead.png">

## Deploying

There is a deploy script that can upload your changes to content.tunapanda.org. In order to use it, it first needs a bit of installation.

Inside the cloned folder, run:
```
npm install
```
In order to install some dependencies required for the deployment script. Each time you want to deploy onto the server, do:

```
export CONTENT_TUNAPANDA_PASSWORD=<the_deployment_password_that_you_need_to_ask_someone_for>
grunt ftpUploadTask
```

Important! Remember to always do:

```
git pull
```

So you have the latest version of the theme on your computer when you deploy it to the live site.

Have fun!
