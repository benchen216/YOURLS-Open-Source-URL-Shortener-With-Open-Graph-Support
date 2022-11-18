# YOURLS Open Source URL Shortener With Open Graph Support

## What is YOURLS?

YOURLS is a set of PHP scripts that will allow you to run your own URL shortening service (a la TinyURL or bit.ly). You'll have full control over your data, detailed stats, analytics, plugins, and more.

## What is Open Graph?

Open Graph is a protocol that allows you to embed rich content into your website. It is used by Facebook, Twitter, Pinterest, and many other social media sites to display a preview of your link when it is shared.

## What is YOURLS Open Graph?

YOURLS Open Graph is a plugin for YOURLS that adds Open Graph support to your YOURLS installation. It allows you to customize the title, description, and image that is displayed when your links are shared on social media sites.

## Installation

1. This is just a redirect plugin, so you need to install YOURLS first. See [YOURLS Installation](https://yourls.org/#Install)
2. Create a database table for the plugin. See sql files `og_image.sql` and `og_image_url.sql`
3. Get Yourls API signature. See [YOURLS API Signature](
4. Configure the plugin by editing the `config.php` file. 

## Configuration

config.php

```php
const SERVER = "localhost";
const DB_USER = "";
const DB_PASS = "";
const DB_NAME = "";    
const RESTRICT_URL = ""; # Restrict the plugin to only work on this domain
const YOURLS_URL = ""; # YOURLS API URL
const DIRECT_URL = ""; # Direct URL to the id page
const YOURLS_SIGNATURE = ""; # YOURLS Signature
```

## Usage

1. admin.php page you can add/~~edit/delete~~ open graph item to database.
2. short.php page you can add/~~edit/delete~~ your links with DIRECT_URL.
3. go.php page you can redirect your links.
