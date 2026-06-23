# top100 plugin for Craft CMS 3.x

top100 plugin

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

* On the project directory, run composer install
* In the backend, apply project config changes

## top100 Overview
This plugin was created to improve performance of top100 including searches and general page loading.

The changes are as follows:
* Query for attraction searches moved from area.twig and _mapview.twig to AreaController
* Query changed to include attraction type and attraction image as part of the query, this dramatically increases 
performance
* Query cache to improve performance for large query delays
* Attraction Data output to the template reduced to contain only required data. This improves performance and memory for
large amounts of data
* Route created for attraction/area to replace the route in control panel
