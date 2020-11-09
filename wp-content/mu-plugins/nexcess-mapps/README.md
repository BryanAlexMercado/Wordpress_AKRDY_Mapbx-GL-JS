# Building on Nexcess MAPPS

Thank you for choosing to build on Nexcess Managed Applications (MAPPS)!

This document is designed to explain the Nexcess MAPPS Must-Use (MU) plugin and how it integrates with our platform, as well as outline the hooks provided by the MU plugin for customers who require more control.


## What is the MU Plugin?

The Nexcess MAPPS MU plugin is designed to be a central place for all of Nexcess' customizations to WordPress at the application level. From cache configurations to the custom dashboard, this MU plugin is the entry point for everything Managed WordPress/WooCommerce.

The MU plugin is maintained by the Managed Applications Product Team within Liquid Web/Nexcess, with new releases about once a month. Our systems automatically update the MU plugin, so every site on our network will be running the same version of the plugin.


## Extending the MU plugin

Considering the amount of functionality in the MU plugin and the fact that it's guaranteed to be present on sites running on Nexcess' Managed WordPress/WooCommerce plans, it may be tempting to (for instance) extend a class define within the MU plugin for your own purposes.

However, **it is not advised to rely on any existing APIs declared within the MU plugin**, as these may change at any time.

The exception to this rule are [the hooks outlined in this document](#customizing-mu-plugin-behavior), to which we commit to supporting for the foreseeable future.


### Deprecated features

Occasionally, we may need to deprecate APIs for the improvement of the overall platform. In those cases, the deprecated methods will be proxied to their replacements (when available), and details about the deprecation will be listed here:

| API | Type | Deprecated In | Alternative |
| --- | --- | --- | --- |
| `nexcess_mapps_disable_dashboard` | filter | 1.12.0 (2020-09-14) | [`nexcess_mapps_show_plugin_installer`](#hide-the-nexcess-plugin-installer) |
| `NEXCESS_MAPPS_USE_LOCAL_DASHBOARD` | constant | 1.12.0 (2020-09-14) | [`nexcess_mapps_show_plugin_installer`](#hide-the-nexcess-plugin-installer) |

Deprecated features will not be _removed_ until the next **major** release of the MU plugin (e.g. if something was deprecated in 1.12.0, it will not be removed before version 2.0.0).


## Customizing MU plugin behavior

The following hooks are provided for customers to modify the behavior of the MU plugin; **anything not covered here may change at any time!**


### Disable the Nexcess MAPPS dashboard

You may hide the "Nexcess" menu item (and any children) with the following filter:

```php
/**
 * Disable the Nexcess MAPPS dashboard.
 */
add_filter( 'nexcess_mapps_show_dashboard', '__return_false' );
```


### Hide the Nexcess plugin installer

The Nexcess plugin installer allows customers to install and license a number of premium plugins included in their plan.

If you wish to disable this functionality, you may do so with the following filter:

```php
/**
 * Disable the Nexcess plugin installer.
 */
add_filter( 'nexcess_mapps_show_plugin_installer', '__return_false' );
```

Previously, this was also available via the `nexcess_mapps_disable_dashboard` filter or the `NEXCESS_MAPPS_USE_LOCAL_DASHBOARD` constant, both of which have been deprecated and will be removed in a future release.
