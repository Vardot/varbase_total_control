[![pipeline status](https://git.drupalcode.org/project/varbase_total_control/badges/9.2.x/pipeline.svg)](https://git.drupalcode.org/project/varbase_total_control/-/pipelines)
[![Varbase Total Control Dashboard](https://img.shields.io/badge/Varbase%20Total%20Control%20Dashboard-9.2.0-0d6efc?labelColor=001d38&style=flat-square)](https://git.drupalcode.org/project/varbase_total_control/-/pipelines?ref=9.2.0)
[![Automated Functional Testing](https://git.drupalcode.org/project/varbase_total_control/badges/9.2.x/pipeline.svg)](https://git.drupalcode.org/project/varbase_total_control/-/pipelines)

# Varbase Total Control Dashboard

A dashboard is what is missing for better Drupal administration experience.

This dashboard is built on top of Total Control Admin Dashboard module,
 utilizing Panels and several enhanced blocks
 and widgets for an intuitive and flexible administration experience.

The idea is made to provide the site admins with appealing and concise
 dashboard to become the home of any Drupal site's administration task.


### Dependencies:
* [Total Control Admin Dashboard](https://www.drupal.org/project/total_control)
* [Charts](https://www.drupal.org/project/charts)


This module is best used with [Varbase](https://www.drupal.org/project/varbase) distribution.

This module is sponsored and developed by [Vardot](https://www.drupal.org/vardot).



### Installation:
Install this module as usual, see
https://www.drupal.org/docs/8/extending-drupal-8/installing-drupal-8-modules

and see https://www.drupal.org/node/2850463#comment-11939958

### Configuration:
Configure user permissions in Administer >> People >> Permissions

  * have total control
    Users in roles with the "have total control" permission will see
    the administration dashboard and all included view pages.

CUSTOMIZATION
--------------
To override the default lists on the dashboard, you have two options:

  1. Edit the settings on the panel pane:
     * Use the cog wheel at the top right of the panel display
     * (or visit Admin > Structure > Pages/Panels)
     * Configure the pane in question (via cog wheel at top right of pane)

  2. Override the default views provided with the total_control module:
     * use the cog wheel at the top right of the view display
     * (or visit Admin > Structure > Views)
