ими_<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":5:{s:12:"last_checked";i:1604871588;s:8:"response";a:2:{s:51:"all-in-one-wp-migration/all-in-one-wp-migration.php";O:8:"stdClass":12:{s:2:"id";s:37:"w.org/plugins/all-in-one-wp-migration";s:4:"slug";s:23:"all-in-one-wp-migration";s:6:"plugin";s:51:"all-in-one-wp-migration/all-in-one-wp-migration.php";s:11:"new_version";s:4:"7.29";s:3:"url";s:54:"https://wordpress.org/plugins/all-in-one-wp-migration/";s:7:"package";s:71:"https://downloads.wordpress.org/plugin/all-in-one-wp-migration.7.29.zip";s:5:"icons";a:2:{s:2:"2x";s:76:"https://ps.w.org/all-in-one-wp-migration/assets/icon-256x256.png?rev=2409765";s:2:"1x";s:76:"https://ps.w.org/all-in-one-wp-migration/assets/icon-128x128.png?rev=2409765";}s:7:"banners";a:2:{s:2:"2x";s:79:"https://ps.w.org/all-in-one-wp-migration/assets/banner-1544x500.png?rev=2409765";s:2:"1x";s:78:"https://ps.w.org/all-in-one-wp-migration/assets/banner-772x250.png?rev=2409765";}s:11:"banners_rtl";a:0:{}s:6:"tested";s:5:"5.5.3";s:12:"requires_php";s:6:"5.2.17";s:13:"compatibility";O:8:"stdClass":0:{}}s:39:"search-filter-pro/search-filter-pro.php";O:8:"stdClass":17:{s:11:"new_version";s:5:"2.5.2";s:14:"stable_version";s:5:"2.5.2";s:4:"name";s:19:"Search & Filter Pro";s:4:"slug";s:17:"search-filter-pro";s:3:"url";s:68:"https://searchandfilter.com/downloads/search-filter-pro/?changelog=1";s:12:"last_updated";s:10:"2 days ago";s:8:"homepage";s:28:"https://searchandfilter.com/";s:7:"package";s:0:"";s:13:"download_link";s:0:"";s:8:"sections";a:3:{s:11:"description";s:864:"<p>Search &amp; Filter Pro is a advanced search and filtering plugin for WordPress.  It allows you to Search &amp; Filter your posts / custom posts / products by any number of parameters allowing your users to easily find what they are looking for on your site, whether it be a blog post, a product in an online shop and much more.</p>
<p>Users can filter by Categories, Tags, Taxonomies, Custom Fields, Post Meta, Post Dates, Post Types and Authors, or any combination of these easily.</p>
<p>Great for searching in your online shop, tested with: WooCommerce and WP eCommerce, Easy Digital Downloads</p>
<h4> Field types include: </h4>
<ul>
<li>dropdown selects</li>
<li>checkboxes</li>
<li>radio buttons</li>
<li>multi selects</li>
<li>range slider</li>
<li>number range</li>
<li>date picker</li>
<li>single or multiselect comboboxes with autocomplete</li>
</ul>";s:9:"changelog";s:44174:"<h4> 2.5.2 </h4>
<ul>
<li>Fix - a warning about stripslashes expecting a string</li>
<li>Fix - an issue where getting labels for ACF fields was failing on private posts</li>
<li>Fix - an issue with infinite scroll not working when the pagination selector was not set</li>
<li>Fix - a JS warning where we using attribute to set checked state in certain admin screens</li>
<li>Fix - an issue where infinite scroll was causing issues on taxonomy archives</li>
<li>Fix - an issue where scrolling to results was fired before the content had loaded, causing an unwanted offset</li>
<li>Fix - an issue with EDD Purchase buttons not using ajax to add to cart after a search</li>
<li>Fix - an issue when WooCommerce is enabled with S&amp;F, and interference being caused to non related search forms</li>
<li>Fix - some compatibility issues with WPML and WooCommerce product variations</li>
<li>New - better integration with WC products shortcode, simply add a <code>search_filter_id</code> argument to integrate</li>
</ul>
<h4> 2.5.1 </h4>
<ul>
<li>NOTICE - if you are using Search &amp; Filter with Easy Digital Downloads please read the new integration notes first</li>
<li>Fix - a PolyLang issue when permalinks were disabled and the default language is not in the URL params</li>
<li>Fix - an issue with range min / max being detected, when using certain post stati</li>
<li>Fix - an issue with a loop not using <code>wp_reset_postdata</code> after</li>
<li>Fix - change another loop so that it improves compatibility with plugins + themes</li>
<li>Fix - respect <code>infinite-scroll-end</code> when it is found on the first page of results</li>
<li>Fix - some compatibility issues with php7.4 using the <code>implode</code> function</li>
<li>Fix - our tables were not being created on some server setups - modified dbdelta sql</li>
<li>Fix - admin - an issue where pagination selector was showing when it shouldn't be</li>
<li>Fix - an issue with setting wpdb prefix at too early, causing an issue in some multisites</li>
<li>Fix - an issue with custom post stati not being picked up properly on cache rebuild</li>
<li>Fix - an issue with Polylang working with our page builder extensions</li>
<li>New - action - <code>search_filter_filter_next_query</code> - runs when the shortcode is run</li>
<li>Improvement - integration with EDD - simply add <code>search_filter_id</code> to you downloads shortcode to get up and running</li>
<li>Security - fix a potential security issue + add some hardening measures</li>
</ul>
<h4> 2.5.0 </h4>
<ul>
<li>Fix - issues with number range fields not setting the &quot;max&quot; value by default</li>
<li>Fix - some errors were being thrown when checking if a term exists</li>
<li>Fix - some php warnings related to an object being countable</li>
<li>Fix - issues with forming the URL for taxonomy archives in certain circumstances</li>
<li>Fix - an issue with the current author being detected when enabling this feature on author archives</li>
<li>Fix - issues with multiple date pickers and auto submit activating properly when selecting a date</li>
<li>Fix - a warning about an undefined variable</li>
<li>Fix - an issue with reset form not working properly on taxonomy archives</li>
<li>Fix - allow <code>update_post_cache</code> action in admin</li>
<li>Fix - an issue with URL encoding in pagination</li>
<li>Fix - an issue with whitespace being removed from user choices in choice fields</li>
<li>Fix - a Polylang issue with the wrong language form being loaded, when auto submit is off</li>
<li>Fix - an issue with URL encoding in sort order fields</li>
<li>Fix - an issue where our meta queries (in query settings) were not respecting WordPress Time Zone when &quot;current date&quot; was used</li>
<li>Fix - an issue when using the OR comparison inside a field, and non latin characters</li>
<li>Fix - an issue with searches not working when pressing the back button on iOS Safari</li>
<li>Fix - an issue with stock status not being stored on the parent product in a variable product</li>
<li>Fix - an issue with WooCommerce shop page, where it was not registering as <code>filtered</code> when using the search input box</li>
<li>Fix - issues detecting post meta for WC variations</li>
<li>Fix - added date and datetime meta type options for ordering by meta values</li>
<li>Fix - re-fix mobile Safari back button issue</li>
<li>Fix - an issue where multiple meta keys with the same name (but different cases) were not being correctly detected</li>
<li>New - added &quot;Relevance&quot; to default order by and sort fields</li>
<li>Improvement - updates to license page</li>
</ul>
<h4> 2.4.6 </h4>
<ul>
<li>Fix - properly disable <code>maintain search form state</code> as this was causing potential security issues</li>
<li>Fix - a character encoding issue when checking if ajax can be enabled on a particular page</li>
<li>Fix - an issue with the sf-option-active class not being removed when using the reset button and submit form is disabled</li>
<li>Fix - some issue with sf-option-active not being set correctly on radio buttons in certain circumstances</li>
<li>Improvement - add support for pagination without the <code>page</code> prefix, ie, the updated Elementor Pro Posts widget uses /%postname%/%pageno%</li>
<li>Improvement - set <code>paged</code> using <code>set_query_var</code> for better compatibility with other plugins</li>
</ul>
<h4> 2.4.5 </h4>
<ul>
<li>Fix - an issue with noUiSlider when &quot;Display values as&quot; is set to &quot;text&quot; in range fields</li>
<li>Fix - an issue with Beaver Builder Themer auto scrolling to results on page load (when using our display method &quot;archive&quot;)</li>
<li>Fix - an issue with Ajax requests and Polylang</li>
<li>Fix - some issues with filtering WC shop in some themes</li>
</ul>
<h4> 2.4.4 </h4>
<ul>
<li>Fix - an error being thrown when creating new sites in wpmu</li>
<li>Fix - return the original IDs of taxonomy terms, when no translated term is found (when using translation plugins) - this allows for taxonomies that are not translated to retain their settings</li>
<li>Fix - an issue where some of our 3rd party integrations were not working in ajax requests (very rare)</li>
<li>Fix - an issue where the <code>filter_next_query</code> shortcode was being ignored in ajax requests</li>
<li>Fix - an issue with Ajax URLs not always being set correctly when using PolyLang</li>
<li>Updated - noUiSlider to v11.1.0</li>
<li>Updated - chosen to v1.8.7</li>
<li>New - added a <code>skip</code> argument for our <code>filter_next_query</code> shortcode, to access those tricky queries</li>
</ul>
<h4> 2.4.3 </h4>
<ul>
<li>Fix - refix enable_taxonomy_archives variable warnings</li>
<li>Fix - an issue with Beaver Builder Themer scrolling to the results on page load (this occured when pagination was set)</li>
<li>Fix - silenced (@)set_time_limit as this was throwing warnings on some hosts</li>
<li>Update - update the plugin to point to our new domain for auth and updates, searchandfilter.com :)</li>
</ul>
<h4> 2.4.2 </h4>
<ul>
<li>Fix - removed an unwanted <code>exit</code> causing various and seemingly unrelated issues</li>
</ul>
<h4> 2.4.1 </h4>
<ul>
<li>New - added JS events <code>sf:ajaxformstart</code> and <code>sf:ajaxformfinish</code> to detect when updating the form has started/finished</li>
<li>Improvement - speed improvements to the cache, when saving posts and when rebuilding the entire cache</li>
<li>Fix - an issue where filtering on taxonomy archives was not working with WooCommerce</li>
<li>Fix - WooCommerce variations were not being taking into consideration in the batch size when rebuilding the cache</li>
<li>Fix - an issue with WC not showing category/taxonomy descriptions or sub categories on archives</li>
<li>Fix - exclude products from results that are &quot;not in catalog&quot; for WC</li>
<li>Fix - an issue where the count was incorrect when using the private publish option with WooCommerce products</li>
<li>Fix - changing a search form settings to include product variations, or not, didn't trigger a rebuild of the cache in some cases</li>
<li>Fix - some WC issues when converting child IDs to parent IDs</li>
<li>Fix - an issue with pagination on taxonomy archives</li>
<li>Fix - an issue with ACF where option labels were not being correctly detected</li>
<li>Fix - an issue with uninstall not working correctly sometimes</li>
<li>Fix - an issue with infinite scroll not activating when the <code>Only use Ajax on the results page</code> setting is off</li>
<li>Fix - an issue with Polylang when searching posts that are not managed by Polylang</li>
</ul>
<h4> 2.4.0 </h4>
<ul>
<li>NOTICE - If you are using S&amp;F with Woocommerce Variations and experiencing issues, you may need to rebuild the S&amp;F cache</li>
<li>New - change the &quot;no results&quot; message for comboboxes</li>
<li>Fix - WooCommerce deprecated <code>woocommerce_get_page_id</code> in 3.0</li>
<li>Fix - various WooCommerce issues relating to Variations - Woocommerce users' who use variations may need to rebuild S&amp;F cache</li>
<li>Fix - correctly set the <code>sf-option-active</code> class on multi select items (this includes checkboxes)</li>
<li>Fix - properly escape some strings</li>
<li>Fix - destroy noUiSlider (if it exists) before init, in case it has been init by another plugin (improved compatibility)</li>
<li>Fix - some issues with levels / nesting of hierarchical taxonomies</li>
<li>Fix - some issues with polylang and ajax requests</li>
<li>Fix - an issue with a number range field not resetting properly</li>
<li>Fix - an issue with the range slider in firefox, when ajax was disabled and auto submit was on</li>
<li>Fix - an issue with <code>enable on taxonomy archives</code> when taxonomies were shared between multiple post types</li>
<li>Fix - a PHP error when using multiple date pickers with post meta</li>
<li>Fix - the infinite scroll loader will now check the parent it is attached to and use the correct html tag for the loader</li>
<li>Fix - an issue with the icon not loading for available fields</li>
<li>Fix - an issue with &quot;enable on taxonomy archives&quot; and pagination not working correctly</li>
<li>Fix - an issue with min / max values being correctly autodetected for range fields</li>
<li>Fix - some issues with rounding &amp; formatting on numeric and slider range fields</li>
<li>Fix - range dropdown &amp; radio fields were not respecting the step value when it came to the last / max option</li>
<li>Fix - some layout issues in the admin</li>
<li>Fix - issues with the later versions of Relevanssi</li>
<li>Fix - some issues with refocusing the search box after a search is performed</li>
<li>Fix - issues with taxonomy rewrites when using <code>enable on taxonomy archives</code></li>
<li>Fix - an issue with the date range fields being auto submitted when only 1 has been selected</li>
<li>Fix - an issue with ACF using <code>get_field_object</code> - and returning the wrong options depending on language</li>
<li>Fix - some issues with the cache building in the background</li>
<li>Fix - some issues with ajax filtering with fragment urls</li>
<li>Fix - a PHP warning when creating the first search form after install</li>
<li>Fix - a PHP warning - incorrect usage of <code>count</code>, displaying warnings when saving posts that are to be cached</li>
<li>Update - update chosen to v1.8.2</li>
<li>Update - update select2 to v4.0.5</li>
</ul>
<h4> 2.3.4 </h4>
<ul>
<li>Fix - issues in some environments where infinite scroll wasn't activating after a performing search, or getting the page var wrong</li>
<li>Fix - infinite scroll offset was not being applied correctly</li>
<li>Improvement - changed scope of some CSS classes in admin ui for better compatibility with other plugins</li>
<li>Fix - some bugs causing issues with 3rd part plugin compatibility</li>
<li>Fix - a bug where S&amp;F wouldn't cache new items added to media</li>
</ul>
<h4> 2.3.3 </h4>
<ul>
<li>New - added action <code>search_filter_api_header</code>, to allow for modification of the headers that are sent with our ajax requests</li>
<li>New - added offset for activation of infinite scroll in the display results tab</li>
<li>New - added new shortcode action <code>filter_next_query</code> - this will apply filtering to the next <code>WP_Query</code> found</li>
<li>Fix - an issue with infinite scroll activating multiple times, if you have multiple instances of a search form on a page</li>
<li>Fix - speed issues with WPML when using media library grid view (and S&amp;F is set to search media)</li>
<li>Fix - incorrect type cast of a settings variable causing settings not to be loaded correctly in some circumstances</li>
</ul>
<h4> 2.3.2 </h4>
<ul>
<li>Fix - PHP warnings &amp; errors when using WooCommerce &amp; Taxonomy Archive display mode</li>
<li>Fix - Some issues with the correct fields appearing in the &quot;display results&quot; tab</li>
</ul>
<h4> 2.3.1 </h4>
<ul>
<li>New - Plugin data (such as saved search forms &amp; cache) will no longer be deleted when uninstalling - to remove all data use the new option in the settings page</li>
<li>New - Search &amp; Filter can now be used to filter your taxonomy archives - currently only works with &quot;Post Type Archive&quot; and &quot;WooCommerce&quot; display methods</li>
<li>Fix - WPML issue was re-introduced in 2.3.0</li>
<li>Fix - A Polylang issue when using the shortcode display method &amp; ajax</li>
<li>Fix - <code>sf-option-active</code> class was not updating when using ajax, with autocount off (as the form no longer gets refreshed)</li>
<li>Fix - issue with &quot;include children in parents&quot; for taxonomy fields</li>
<li>Fix - an issue with <code>?sf_data</code> being appended to pagination in ajax requests</li>
<li>Fix - issue with Visual Composer plugin only working after first interaction (ajax)</li>
<li>Fix - an issue with infinite scroll triggering on incorrect pages</li>
<li>Fix - an issue where the <code>sf_results_url</code> filter was not being applied to pagination</li>
<li>Fix - an issue with Archive display method &amp; polylang</li>
<li>Compatibility - store the results URL in its own custom field for better compatibility with migration tools which search/replace urls. <em>Notice</em>, you will need to edit and hit &quot;save&quot; in your search forms before migrating your sites (so the url can be copied in to the correct custom field)</li>
</ul>
<h4> 2.3.0 </h4>
<ul>
<li>New - Added support for visual composer post grids (free addon plugin required) - create results layouts using visual composer!</li>
<li>New - Infinite scroll for all display methods - how to setup - <a href="https://searchandfilter.com/documentation/search-results/infinite-scroll/">https://searchandfilter.com/documentation/search-results/infinite-scroll/</a></li>
<li>New - Added support for ACF relationship fields</li>
<li>New - added <code>none</code> sort order option for choice meta fields, allowing preservation of the order of options (if set from external plugins)</li>
<li>New - added option to specify decimal seperator for number range fields</li>
<li>Update - Select2 JS library to 4.0.3</li>
<li>Update - Chosen JS library to 1.6.2</li>
<li>Update - noUiSlider JS library to 8.5.1</li>
<li>Performance - improvements when generating forms with many options</li>
<li>Performance - do not reload the S&amp;F form (ajax) if auto count is not enabled - speed improvement</li>
<li>Performance - store search related data in transients so that search forms are rendered quickly when used outside of Results Pages (enable via settings page)</li>
<li>Performance - improved cache building speeds</li>
<li>Fix - combobox issues on touch devices</li>
<li>Fix - thousands seperator was not displaying for certain input types</li>
<li>Fix - some issues with Polylang plugin after Polylang updates</li>
<li>Fix - issues with the post type field not being set</li>
<li>Fix - IDs for input fields are now generated randomly based on current timestamp - using the same search form multiple times on a page caused errors with labels &amp; IDs (clicking a label in one form would update the other instance)</li>
<li>Fix - an issue when using <code>update_post_cache</code> filter on already deleted posts</li>
<li>Fix - PHP notices when using Woocommerce with a static homepage</li>
<li>Fix - variatons not working correctly in woocommerce, S&amp;F was returning matches for attribute combinations (of variations) which did not exist, but did exist within a particular product</li>
<li>Fix - potential infinite loop when results contain results shortcodes :/</li>
<li>Fix - &quot;Only use Ajax on the results page&quot; was not working correctly on post type archives when the taxonomy archives were based of the post type archive URL</li>
<li>Fix - S&amp;F pagination was taking over taxonomy archive pagination when the display method was set to <code>post type archive</code> and the taxonomy archives path had the post type as base rewrite</li>
<li>Fix - <code>hide empty</code> and <code>show count</code> options no longer have any effect when auto count is disabled.</li>
<li>Fix - default sorting by numeric meta keys was not working when they were decimals / floating point numbers.. all numeric sorting is now converted to decimal sorting to 4 decimal places which also works for standard numeric sorting</li>
<li>Fix - an issue where numerical ranges using the &quot;overlap&quot; comparison were not returning  the correct results</li>
<li>Fix - an issue where numerical ranges were not auto detecing the max value correctly, when using different start/end meta keys</li>
<li>Fix - issues with WPML &amp; PolyLang</li>
<li>Fix - some issues with Ajax when using ajax in certain display modes</li>
<li>Fix - issues when search forms are within the results area, and replaced with an ajax request</li>
<li>Removed - help tab on admin screens as it was unused</li>
</ul>
<h4> 2.2.0 </h4>
<ul>
<li>New - field - posts per page</li>
<li>New - added system status screen</li>
<li>New - Added Select2 JS as an alternative to Chosen for comboboxes - seems to have better mobile support - change this in main S&amp;F settings screen</li>
<li>New - added support for custom post stati (statuses)</li>
<li>New - use slugs instead of IDs in shortcodes (check the shortcodes metabox)</li>
<li>Improved - allow post meta keys and values to contain spaces &amp; special characters</li>
<li>Improved - updated Chosen JS to - v1.5.2</li>
<li>Improved - reset button - choose if the reset button submits the form after resetting it</li>
<li>Improved - new admin notices for settings that can potentially cause errors</li>
<li>Improved - admin UI tweaks</li>
<li>Improved - added <code>stop()</code> to scrolling animations before starting to scroll the page</li>
<li>Fix - issues with PHP 7</li>
<li>Fix - properly escape some input fields</li>
<li>Fix - S&amp;F incorrectly warning network activated plugins are not enabled</li>
<li>Fix - refocus input fields after the form has been auto submitted</li>
<li>Fix - an error with the range slider and decimals</li>
<li>Fix - JS event &quot;sf:ajaxfinish&quot; now fired after all S&amp;F process have completed (such as updating the search form)</li>
<li>Fix - various pagination issues</li>
<li>Fix - an issue with pagination and the new <code>custom</code> display method</li>
<li>Fix - renamed a global function to prevent conflicts</li>
<li>Fix - Display problems when using WooCommerce shop on the homepage with S&amp;F</li>
<li>Fix - Issues with the woocommerce orderby dropdown</li>
<li>Fix - an issue with the action <code>search_filter_query_posts</code> not working correctly</li>
<li>Fix - a bug sometimes causing tag and category fields to be detected as undefined causing search issues</li>
<li>Fix - issues with detecting when attachments were updated and rebuilding the cache</li>
<li>Fix - pressing enter in the search box reset the timer for autosubmit</li>
<li>Fix - added EDD prep_query shortcode to shortcodes box</li>
<li>Fix - fix some compatibility issues with WPML where WPML was converting taxonomy term IDs into the current language rather than post language</li>
<li>Fix - use global function <code>get_queried_object</code> rather than <code>$wp_query-&gt;queried_object</code> for consistency</li>
<li>Fix - issues with the author field and detecting defaults</li>
<li>Notice - WP 4.6 tested &amp; compatible + PHP 7</li>
</ul>
<h4> 2.1.2 </h4>
<ul>
<li>New - Sort order can be displayed as radio buttons</li>
<li>New - filters for all URLs used in S&amp;F - this allows for dynamically changing the various URLs for example to force https or similar - <a href="https://searchandfilter.com/documentation/action-filter-reference/">https://searchandfilter.com/documentation/action-filter-reference/</a></li>
<li>Fix - an issue with <code>include_children</code> and allowing the AND operator to be used</li>
<li>Fix - an issue with hierarchical lists not being display correctly</li>
</ul>
<h4> 2.1.1 </h4>
<ul>
<li>New - added <code>data-sf-count</code> attributes to inputs which have count variables</li>
<li>Improvement - default cache speed is set to slow</li>
<li>Fix - an issue with pagination filters</li>
<li>Fix - issues with PolyLang - should now be working again with PolyLang v1.7.12</li>
<li>Fix - minify issues with CSS &amp; JS files</li>
<li>Fix - issues with depth in hierarchical fields</li>
<li>Fix - an issue where S&amp;F was hijacking pagination when it wasn't supposed to</li>
<li>Fix - a couple of minor issues with the author field</li>
<li>Fix - S&amp;F <code>sf:init</code> was incorrectly firing after each ajax request, it is now fired only on page load &amp; once initialised</li>
<li>Fix - An issue where post date fields were not being set correctly in the front end</li>
<li>Fix - a PHP/pass by reference overload issue</li>
<li>Fix - an issue with <code>number_format</code> &amp; PHP warnings in admin</li>
<li>Fix - an issue with undefined taxonomy slugs in the S&amp;F cache</li>
<li>Fix - an issue with <code>wp_json_encode</code></li>
</ul>
<h4> 2.1.0 </h4>
<ul>
<li>Notice - depth classes for hierarchical fields fields have renamed to avoid conflicts - from <code>.level-0</code> to <code>.sf-level-0</code></li>
<li>Notice - properly prefix range &amp; min / max classes = from <code>.range-min</code>, <code>.range-max</code> and <code>.meta-range</code>  to <code>.sf-range-min</code>, <code>.sf-range-max</code> and <code>.sf-meta-range</code></li>
<li>New - sync meta fields - when using &quot;number&quot; or &quot;choice&quot; type meta fields, the values can now be auto detected - values can also be sorted</li>
<li>New - sync ACF fields - use above in choice fields with auto detection - S&amp;F can now retreive built in ACF labels for values too</li>
<li>New - added support for ordering by multiple fields (the default posts order)</li>
<li>New - added support for ordering posts by Post Type</li>
<li>New - lots of improvements to post meta fields (number) more UI options and input types</li>
<li>New - added support for decimals and number formatting in post meta (number) fields</li>
<li>New - new compare options for date range and number fields - great for date ranges and bookings/promotional systems</li>
<li>New - added sort by relevance option for Relevanssi under the Advanced tab</li>
<li>New - added options to control the display of sticky posts (under the Posts tab)</li>
<li>New - Settings page</li>
<li>New - Settings - control caching speed &amp; background processes</li>
<li>New - Settings - added settings to lazyload JS and an option to load jQuery language files for the datepicker</li>
<li>New - accessibility - WCAG 2.0 compliant - some html restructuring (mostly adding in labels) and added screen reader text option to all text/number input fields and selects</li>
<li>New - filter - allows users to filter any field in the search form and most of the options</li>
<li>New - added counts to the active query class</li>
<li>Improvement - authors now use slugs instead of IDs in the URL</li>
<li>Improvement - updated Chosen &amp; noUiSlider to their latest versions</li>
<li>Improvement - show internal taxonomy names as well as labels throughout admin UI</li>
<li>Improvement - support for WooCommerce shop when it is set to category display</li>
<li>Improvement - speed updates/optimisations to the cache and auto count</li>
<li>Improvement - better admin notices &amp; warnings</li>
<li>Fix - issues with WPML and loading the correct taxonomies etc</li>
<li>Fix - issues with caching and the attachment post type</li>
<li>Fix - an issue where getting counts for taxonomies was occuring twice</li>
<li>Fix - URL Encoding issue with meta fields</li>
<li>Fix - an issue when using multiple search forms on a single page &amp; pagination not working correctly</li>
<li>Fix - removed an error message which was showing whenever the cache was restarting - it was unnecessary</li>
<li>Fix - whitespace being trimmed from textareas in certain field types</li>
<li>Fix - some pagination issues when using post type archive</li>
<li>Fix - do not enable auto count by default</li>
<li>Fix - Post Type archive display method now properly uses the Posts Page (as defined under <code>settings</code> -&gt; <code>reading</code>) where applicable when the post type is set to <code>post</code></li>
<li>Fix - a bug where html entities were matched when searching in chosen comboboxes such as <code>nbsp</code></li>
<li>Fix - an admin bug where selecting Post Type Archive as the results method would show the wrong options after saving</li>
<li>Fix - a few admin UI bugs</li>
<li>Fix - a bug with the ajax start/end events</li>
<li>WP 4.4 compat - tested with 2016 theme</li>
</ul>
<h4> 2.0.3 </h4>
<ul>
<li>New - update search form (auto count) without submitting the form</li>
<li>New - added variable <code>search_filter_id</code> to all queries to easily identify which S&amp;F form your queries are being modified by - use <code>$query['search_filter_id'];</code></li>
<li>New - added RTL support for all JS plugins - chosen comboxbox, jQuery datepicker and noUiSlider</li>
<li>New - added action to trigger the rebuild of the cache for a specific post (<code>do_action('search_filter_update_post_cache', 1984);</code> where 1984 is the post ID)</li>
<li>Fix - issue with Firefox &quot;rembering&quot; disabled state on soft refresh - now a soft page refresh in FF also forces all inputs to be enabled to overcome this issue</li>
<li>Fix - issue with comboboxes finding child terms (hierarchical enabled)</li>
<li>Fix - issue with URI encoding in search field</li>
<li>Fix - issues with multiple results shortcodes when meta data defaults are set</li>
<li>Fix - issues with WP Types plugin and nested post meta values</li>
<li>Fix - caching issues with post meta when there are multiple values</li>
<li>Fix - issue with search term &amp; stripslashes</li>
<li>Fix - compatibility issue with Relevanssi</li>
<li>Fix - correctly show count numbers when &quot;detect defaults from current page&quot; is selected</li>
<li>Fix - re-implement <code>save_post</code> filter outside of <code>is_admin</code> for rebuilding the cache from the front end</li>
</ul>
<h4> 2.0.2 </h4>
<ul>
<li>New - use S&amp;F with even more templates (Archive Mode) by adding a shortcode/action before your loop</li>
<li>Fix - set priority of Ajax (with results shortcode) search to <code>200</code> on <code>init</code> hook - it was being fired sometimes before taxonomies had been declared</li>
<li>Fix - <code>array_merge</code> errors when using hierarchical taxonomies and including children in parents</li>
<li>Fix - JS errors with multiple search forms on the same page at the same time</li>
<li>Fix - JS error error in Firefox where refreshing the page sometimes caused a disabled state on the search form</li>
<li>Fix - an issue in Avada + woocommerce, when setting up the query, and only using 1 post type S&amp;F now passes a string instead of an array</li>
<li>Fix - a PHP error and delimiters in the Active Query class</li>
<li>Fix - an issue with maintain search form state passing <code>page_id</code> when permalinks are disabled</li>
<li>Fix - undefined variable notice in author walker</li>
<li>Fix - undefined variable notice in edit search form screen</li>
</ul>
<h4> 2.0.1 </h4>
<ul>
<li>NOTICE - DO NOT UPDATE UNTIL YOU HAVE READ THE RELEASE NOTES: <a href="https://searchandfilter.com/documentation/2-0-upgrade-notes/">https://searchandfilter.com/documentation/2-0-upgrade-notes/</a></li>
<li>Version bump so all beta testers get the latest update via the dashboard</li>
</ul>
<h4> 2.0 </h4>
<ul>
<li>New - caching of results for fast speeds even on large databases</li>
<li>New - direct support for the WooCommerce shop page</li>
<li>New - direct support for WooCommerce product variations</li>
<li>New - integration with Easy Digital Downloads (EDD) shortcodes - just add the S&amp;F prep_query shortcode directly before the EDD shortcode ie - <code>[searchandfilter id="14" action="prep_query"]</code></li>
<li>New - use post type archives to display your results (single post type only)</li>
<li>New - huge speed and accuracy improvements for meta queries - no more <code>%like%</code> queries for serialised meta</li>
<li>New - auto count - dynamically display counts next to field options based on the current search &amp; settings</li>
<li>New - auto count - drill down fields - hide options which yield no results</li>
<li>New - allow for multiple meta keys to be queried when doing ranges</li>
<li>New - prepolutate search form based on current archive - works for post types, tags, categories, taxonomies and authors</li>
<li>New - datepicker - supports jQuery UI i18n, dropdown for years &amp; months option, placeholder text customisation</li>
<li>New - methods for accessing what has been searched</li>
<li>Improvement - moved all Ajax logic to front end for better compatibility with other plugins (esp shortcode based)</li>
<li>Improvement - huge amount of refactoring - some parts completely rewritten and optimized, JS rewrite</li>
<li>Improvement - show which meta keys are selected in widget title</li>
<li>Improvement - change labels on checkbox and radio fields - don't wrap the inputs inside the labels</li>
<li>Fix - some problems with pagination links sometimes pointing to the ajax URL</li>
<li>Fix - Fix an issue with <code>include_children</code> now working</li>
<li>New - relationships can now be defined across taxonomy and meta fields</li>
<li>Fix - Issues with pagination</li>
<li>fix - removed references to CSS images that were not being used</li>
<li>Fix - localised some sloppy CSS rules for compatibility</li>
<li>Fix - some issues with currencies and decimals when using number ranges</li>
<li>Fix - an issue with exclude post IDs not working correctly</li>
<li>Fix - UTF characters in taxonomy term names</li>
<li>Fix - <code>orderby</code> getting added to the URL on non WooCommerce search forms</li>
<li>Fix - IE8 JS error - Object.keys() compatibility</li>
<li>Fix - IE10 JS error / reload error - the <code>input</code> event was triggering when it was not supposed to causing an ajax request to be performed</li>
<li>Fix - Admin - function definition in wrong scope causing errors in strict mode on some browsers</li>
<li>Removed - .postform classes that have crept back into build - but added classes and IDs on every input element</li>
<li>Removed - the global $sf_form_data - changed to $searchandfilter</li>
<li>Notice - you should no longer use <code>pre_get_posts</code> to modify queries, there is a new filter which takes an array of arguments <code>sf_edit_query_args</code> which must be used to also update count number and other non main queries</li>
<li>In progress - support for PolyLang - testing so far seems good</li>
</ul>
<h4> 1.4.3.1 </h4>
<ul>
<li>Fix - add serialised tick box to post meta fields</li>
<li>Fix - added a &quot;data is serialised&quot; checkbox to meta fields</li>
<li>Dropped - built in pagination functions - <code>sf_pagination_numbers</code> and <code>sf_pagination_prev_next</code> are now redundant</li>
</ul>
<h4> 1.4.1 </h4>
<ul>
<li>New - Added IDs to search forms for easy css targeting - also renamed ID on results container to keep in line with naming conventions</li>
<li>New - added reset button</li>
<li>New - dropdown number range</li>
<li>New - added options to use timestamps in post meta</li>
<li>fix - a bug when sanitizing keys from post meta</li>
<li>fix - a bug with autosuggest &amp; encoding</li>
<li>fix - issues with searching serialised post meta</li>
<li>fix - throwing an error when trying to access the <code>all_items</code> label of a taxonomy when it does not exist</li>
<li>fix - some dependencies with JS/CSS allowing them to be removed more easily</li>
<li>fix - some tweaks to automatic updates</li>
<li>fix - layout issues with search form UI and WP 4.1</li>
<li>fix - various fixes and improvements with compatibility and WPML</li>
</ul>
<h4> 1.4.0 </h4>
<ul>
<li>New - search media/attachments</li>
<li>New - added post meta defaults - now you can add constraints for meta data such as searching only products in stock, excluding featured posts or restricting all searches to specific meta data values</li>
<li>New - scroll to top of page when updating results with ajax</li>
<li>New - use the shortcode to display results without ajax too (results shortcode only worked with ajax setups previously)</li>
<li>New - allow regular pagination when using a shortcode for results - (use wp next_posts_link &amp; previous_posts_link, plus added support for wp_pagenavi plugin)</li>
<li>New - added AND / OR operator to define relationships between tag, category and taxonomy fields</li>
<li>New - optionally include children in parent searches (categories, hierarchical taxonomies)</li>
<li>New - improvded UI - add taxonomy browser to help find IDs easily</li>
<li>New - improved ajax/template UI</li>
<li>New - minify CSS &amp; JS - finally integrated grunt ;) - non minified versions still available</li>
<li>New - duplicate search form - a link has been added to the main S&amp;F admin screen underneath each form for easy duplicating!</li>
<li>New - added support for Relevanssi when using shortcodes to display results</li>
<li>New - add &quot;today&quot; for date comparisons in meta queries in post meta defaults</li>
<li>Updated - the default results template (shortcode) to include new pagination options</li>
<li>Fixed - an error when users are not using permalinks, and submitting the search form</li>
<li>Fixed - &quot;OR&quot; operator for checkboxes with taxonomies was broken</li>
<li>Fixed - a JS error when no terms were being shown for a checkbox/radio field</li>
<li>Fixed - an error when using <code>maintain state</code> and getting 404 on results</li>
<li>Fixed - an error when detecting if a meta field was serialised or not</li>
<li>Fixed - an error when saving a post meta field with a poorly formatted name</li>
<li>Fixed - ajax pagination without shortcode</li>
<li>Fixed - meta fields with the value <code>0</code> being ignored</li>
<li>Fixed - some updates to the plugin auto updater - some users weren't seeing udpates in the dashboard even when activated</li>
</ul>
<h4> 1.3.0 </h4>
<ul>
<li>New - JavaScript rewrite - refactored - faster cleaner code</li>
<li>New - add setting to allow the default sort order of results - check settings panel -&gt; posts</li>
<li>New - Speed improvements - searching usually caused 2 header requests (a POST and a redirect) - now uses only a single GET request</li>
<li>New - play nice with other scripts - can now initialise the search form via JS if the form/html is loaded in dynamically</li>
<li>New - mulitple search forms on the same page!</li>
<li>New - add data to JS events for targeting individual forms on the same page</li>
<li>New - maintain search state - keep user search settings while looking at results pages</li>
<li>New - for Ajax w/ Shortcodes - Added results URL - this allows the widget to be placed anywhere in your site</li>
<li>New - shortcode meta box - for easier access to shortcodes within the Search Form editor</li>
<li>New - allow auto submit when ajax is not enabled</li>
<li>New - shareable/bookmarkable URLs when using shortcodes (this was already available without)</li>
<li>Fixed - an issue with auto submit</li>
<li>Fixed - an issue with a significant delay to fetch initial results when using ajax (with shortcode) - initial results are now loaded server side on page load</li>
<li>Fixed - bad html and &quot;hide_empty&quot; was not working as expected - it was disabling inputs rather than hiding them</li>
<li>Fixed - i18n for &quot;prev&quot; and &quot;next&quot; in pagination</li>
<li>Fixed - post date field was not working correctly when using ajax w/ shortcodes</li>
<li>Improved - integration with WPML - better URLs and works fully with shortcodes</li>
<li>Removed - <em>Beta</em> Auto Count - this feature is likely to be even more broken (it had plenty of bugs already) - it is recommended you disable this for now.  The next major update will inlcude a revised &amp; working version of this.</li>
</ul>
<h4> 1.2.7 </h4>
<ul>
<li>Fixed an issue with array_replace_recursive for older PHP version</li>
</ul>
<h4> 1.2.6 </h4>
<ul>
<li>Fixed an issue with headers in admin when publishing a post</li>
</ul>
<h4> 1.2.5 </h4>
<ul>
<li>Fixed a JS error in IE8</li>
<li>Added new settings panel - set defaults search parameters</li>
<li>Settings Panel - include/exclude categories</li>
<li>Settings Panel - exclude posts by ID</li>
<li>Settings Panel - choose to search by Post Status</li>
<li>Settings Panel - Added Results Per Page for controlling the number of results you see</li>
<li>Settings Panel - UI refinements</li>
<li>Settings Panel - more to come (meta)!</li>
<li>Category, Tag &amp; Taxonomy fields - new option (advanced) to sync included/excluded posts with new settings parameters</li>
</ul>
<h4> 1.2.4 </h4>
<ul>
<li>DO NOT UPGRADE IF YOU WERE HAVING ISSUES WITH AJAX FUNCTIONALITY AND WAITING FOR A PATCH, ONLY THE TWO UPDATES BELOW ARE INCLUDED IN THIS UPDATE:</li>
<li>Fix - ajax shortcode functionality - search field is now working again!</li>
<li>Fix - ajax shortcode functionality - fixed custom field/meta search</li>
<li>Fix - ajax shortcode functionality - fixed a bug with categories</li>
</ul>
<h4> 1.2.3 </h4>
<ul>
<li>DO NOT UPGRADE IF YOU WERE HAVING ISSUES WITH AJAX FUNCTIONALITY AND WAITING FOR A PATCH, ONLY THE TWO UPDATES BELOW ARE INCLUDED IN THIS UPDATE:</li>
<li>Fix - ajax shortcode functionality - only displays published posts (it was also fetching drafts)</li>
<li>Fix - ajax shortcode functionality - auto submit now working</li>
</ul>
<h4> 1.2.2 </h4>
<ul>
<li>Fix - stopped using short syntax array in php (<code>[]</code>) which is only supported in php version 5.4+</li>
</ul>
<h4> 1.2.1 </h4>
<ul>
<li>Fix - a JS error for older Ajax setups</li>
</ul>
<h4> 1.2.0 </h4>
<ul>
<li>NEW - completely reworked how to use Ajax - simply use a shortcode to place where you want the results to display and you're set to go!</li>
<li>Fix - allow paths in template names - S&amp;F was previously stripping out slashes so couldn't access templates in sub directories</li>
<li>Fix - various small bug fixes</li>
</ul>
<h4> 1.1.8 </h4>
<ul>
<li>New - add new way to modify the main search query for individual forms</li>
<li>New - added a new JS init event</li>
</ul>
<h4> 1.1.7 </h4>
<ul>
<li>New - <em>beta</em> - Auto count for taxonomies - when using tag, category and taxonomies only in a search form, you can now enable a live update of fields, which means as users make filter selections, unavailable combinations will be hidden (this is beta and would love feedback especially from users with high numbers of posts/taxonomies)</li>
<li>New - date picker for custom fields / post meta - dates must be stored as YYYYMMDD or as timestamps in order to use this field</li>
<li>New - added JS events to capture start / end of ajax loading so you can add in your own custom loaders</li>
<li>Fix - prefixed taxonomy and meta field names properly - there were collisions on the set defaults function, for example if a tax and meta share the same key there would be a collision</li>
<li>Fix - errors with number ranges &amp; range slider</li>
<li>Fix - an error with detecting if a meta value is serialized</li>
<li>Fix - scope issue with date fields auto submitting correctly</li>
</ul>
<h4> 1.1.6 </h4>
<ul>
<li><strong>Notice</strong> - dropped - <code>.postform</code> css class  this was redundant and left in by error - any users using this should update their CSS to use the new and improved options provided:</li>
<li>New - class names added to all field list items for easy CSS styling + added classes to all options for form inputs for easy targeting of specific field values</li>
<li>New - added a <code>&lt;span class="sf-count"&gt;</code> wrapper to all fields where a count was being shown for easy styling</li>
<li>Fix - removed all reference to <code>__DIR__</code> for PHP versions &lt; 5.3</li>
<li>Fix - Some general tweaks for WPML</li>
<li>Fix - a bug when choosing all post types still adding &quot;post_types&quot; to the url</li>
</ul>
<h4> 1.1.5 </h4>
<ul>
<li><strong>Notice</strong> - this update breaks previous Sort Order fields, so make sure if you have a Sort Order Field to rebuild it once you've updated!</li>
<li>New - Sort Order - in addition to sorting by Meta Value, users can now sort their results by ID, author, title, name, date, date modified, parent ID, random, comment count and menu order, users can also choose whether they they want only ASC or DESC directions - both are optional.</li>
<li>New - Autocomplete Comboboxes - user friendly select boxes powered by Chosen - text input with auto-complete for selects and multiple selects - just tick the box when choosing a select or multiselect input type</li>
<li>Fix - add a lower priority to <code>init</code> hook when parsing taxonomies - this helps ensure S&amp;F runs after your custom taxonomies have been created</li>
<li>Fix - add a lower priority to <code>pre_get_posts</code> - helps with modifying the main query after other plugins/custom code have run</li>
<li>Fix - a problem with meta values having spaces</li>
</ul>
<h4> 1.1.4 </h4>
<ul>
<li>New - Meta Suggestions - auto detect values for your custom fields / post meta</li>
<li>Enhancement - improved Post Meta UI (admin)</li>
<li>Fix - an error with displaying templates (there was a PHP error being thrown in some environments)</li>
<li>Fix - an error where ajax enabled search forms were causing a refresh loop on some mobile browsers</li>
</ul>
<h4> 1.1.3 </h4>
<ul>
<li>New - display meta data as dropdowns, checkboxes, radio buttons and multi selects</li>
<li>New - added date formats to date field</li>
<li>fix - auto submit &amp; date picker issues</li>
<li>fix - widget titles not displaying</li>
<li>fix - missed a history.pushstate check for AJAX enabled search forms</li>
<li>fix - dashboard menu conflict with other plugins</li>
<li>fix - submit label was not updating</li>
<li>fix - post count for authors was showing only for posts - now works with all post types</li>
<li>compat - add fallback for <code>array_replace</code> for &lt;= PHP 5.3 users</li>
</ul>
<h4> 1.1.2 </h4>
<ul>
<li>New - customsise results URL - add a slug for your search results to display on (eg yousite.com/product-search)</li>
<li>fix - js error when Ajax pagination links are undefined</li>
<li>fix - date picker dom structure updated to match that of all other fields</li>
<li>fix - scope issue when using auto submit on Ajax search forms</li>
</ul>
<h4> 1.1.1 </h4>
<ul>
<li>fix - fixed an error where JS would hide the submit button :/</li>
<li>fix - fixed an error where parent categories/taxonomies weren't showing their results</li>
</ul>
<h4> 1.1.0 </h4>
<ul>
<li>New - AJAX - searches can be performed using Ajax</li>
<li>fix - removed redundant js/css calls</li>
</ul>
<h4> 1.0.0 </h4>
<ul>
<li>Initial release</li>
</ul>";s:12:"installation";s:634:"<h4> Uploading in WordPress Dashboard </h4>
<ol>
<li>Navigate to the 'Add New' in the plugins dashboard</li>
<li>Navigate to the 'Upload' area</li>
<li>Select <code>search-filter-pro.zip</code> from your computer</li>
<li>Click 'Install Now'</li>
<li>Activate the plugin in the Plugin dashboard</li>
</ol>
<h4> Using FTP </h4>
<ol>
<li>Download <code>search-filter-pro.zip</code></li>
<li>Extract the <code>search-filter-pro</code> directory to your computer</li>
<li>Upload the <code>search-filter-pro</code> directory to the <code>/wp-content/plugins/</code> directory</li>
<li>Activate the plugin in the Plugin dashboard</li>
</ol>";}s:7:"banners";s:41:"a:2:{s:4:"high";s:0:"";s:3:"low";s:0:"";}";s:5:"icons";s:6:"a:0:{}";s:12:"contributors";O:8:"stdClass":2:{s:14:"DesignsAndCode";O:8:"stdClass":3:{s:12:"display_name";s:14:"DesignsAndCode";s:7:"profile";s:39:"//profiles.wordpress.org/DesignsAndCode";s:6:"avatar";s:59:"https://wordpress.org/grav-redirect.php?user=DesignsAndCode";}s:7:"CodeAmp";O:8:"stdClass":3:{s:12:"display_name";s:7:"CodeAmp";s:7:"profile";s:32:"//profiles.wordpress.org/CodeAmp";s:6:"avatar";s:52:"https://wordpress.org/grav-redirect.php?user=CodeAmp";}}s:10:"stable_tag";s:5:"2.5.2";s:7:"license";s:0:"";s:6:"tested";s:3:"4.9";s:5:"added";s:10:"2014-05-10";}}s:12:"translations";a:0:{}s:9:"no_update";a:24:{s:19:"akismet/akismet.php";O:8:"stdClass":9:{s:2:"id";s:21:"w.org/plugins/akismet";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:5:"4.1.7";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:56:"https://downloads.wordpress.org/plugin/akismet.4.1.7.zip";s:5:"icons";a:2:{s:2:"2x";s:59:"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272";s:2:"1x";s:59:"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272";}s:7:"banners";a:1:{s:2:"1x";s:61:"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904";}s:11:"banners_rtl";a:0:{}}s:37:"breadcrumb-navxt/breadcrumb-navxt.php";O:8:"stdClass":9:{s:2:"id";s:30:"w.org/plugins/breadcrumb-navxt";s:4:"slug";s:16:"breadcrumb-navxt";s:6:"plugin";s:37:"breadcrumb-navxt/breadcrumb-navxt.php";s:11:"new_version";s:5:"6.6.0";s:3:"url";s:47:"https://wordpress.org/plugins/breadcrumb-navxt/";s:7:"package";s:65:"https://downloads.wordpress.org/plugin/breadcrumb-navxt.6.6.0.zip";s:5:"icons";a:3:{s:2:"2x";s:69:"https://ps.w.org/breadcrumb-navxt/assets/icon-256x256.png?rev=2410525";s:2:"1x";s:61:"https://ps.w.org/breadcrumb-navxt/assets/icon.svg?rev=1927103";s:3:"svg";s:61:"https://ps.w.org/breadcrumb-navxt/assets/icon.svg?rev=1927103";}s:7:"banners";a:2:{s:2:"2x";s:72:"https://ps.w.org/breadcrumb-navxt/assets/banner-1544x500.png?rev=1927103";s:2:"1x";s:71:"https://ps.w.org/breadcrumb-navxt/assets/banner-772x250.png?rev=1927103";}s:11:"banners_rtl";a:0:{}}s:27:"cdn-enabler/cdn-enabler.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/cdn-enabler";s:4:"slug";s:11:"cdn-enabler";s:6:"plugin";s:27:"cdn-enabler/cdn-enabler.php";s:11:"new_version";s:5:"1.0.9";s:3:"url";s:42:"https://wordpress.org/plugins/cdn-enabler/";s:7:"package";s:54:"https://downloads.wordpress.org/plugin/cdn-enabler.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/cdn-enabler/assets/icon-256x256.png?rev=1206794";s:2:"1x";s:64:"https://ps.w.org/cdn-enabler/assets/icon-128x128.png?rev=1206794";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/cdn-enabler/assets/banner-1544x500.png?rev=1206794";s:2:"1x";s:66:"https://ps.w.org/cdn-enabler/assets/banner-772x250.png?rev=1206794";}s:11:"banners_rtl";a:0:{}}s:43:"custom-post-type-ui/custom-post-type-ui.php";O:8:"stdClass":9:{s:2:"id";s:33:"w.org/plugins/custom-post-type-ui";s:4:"slug";s:19:"custom-post-type-ui";s:6:"plugin";s:43:"custom-post-type-ui/custom-post-type-ui.php";s:11:"new_version";s:5:"1.8.1";s:3:"url";s:50:"https://wordpress.org/plugins/custom-post-type-ui/";s:7:"package";s:68:"https://downloads.wordpress.org/plugin/custom-post-type-ui.1.8.1.zip";s:5:"icons";a:2:{s:2:"2x";s:72:"https://ps.w.org/custom-post-type-ui/assets/icon-256x256.png?rev=1069557";s:2:"1x";s:72:"https://ps.w.org/custom-post-type-ui/assets/icon-128x128.png?rev=1069557";}s:7:"banners";a:2:{s:2:"2x";s:75:"https://ps.w.org/custom-post-type-ui/assets/banner-1544x500.png?rev=1069557";s:2:"1x";s:74:"https://ps.w.org/custom-post-type-ui/assets/banner-772x250.png?rev=1069557";}s:11:"banners_rtl";a:0:{}}s:23:"elementor/elementor.php";O:8:"stdClass":9:{s:2:"id";s:23:"w.org/plugins/elementor";s:4:"slug";s:9:"elementor";s:6:"plugin";s:23:"elementor/elementor.php";s:11:"new_version";s:6:"3.0.13";s:3:"url";s:40:"https://wordpress.org/plugins/elementor/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/elementor.3.0.13.zip";s:5:"icons";a:3:{s:2:"2x";s:62:"https://ps.w.org/elementor/assets/icon-256x256.png?rev=1427768";s:2:"1x";s:54:"https://ps.w.org/elementor/assets/icon.svg?rev=1426809";s:3:"svg";s:54:"https://ps.w.org/elementor/assets/icon.svg?rev=1426809";}s:7:"banners";a:2:{s:2:"2x";s:65:"https://ps.w.org/elementor/assets/banner-1544x500.png?rev=1475479";s:2:"1x";s:64:"https://ps.w.org/elementor/assets/banner-772x250.png?rev=1475479";}s:11:"banners_rtl";a:0:{}}s:31:"everest-forms/everest-forms.php";O:8:"stdClass":9:{s:2:"id";s:27:"w.org/plugins/everest-forms";s:4:"slug";s:13:"everest-forms";s:6:"plugin";s:31:"everest-forms/everest-forms.php";s:11:"new_version";s:5:"1.7.2";s:3:"url";s:44:"https://wordpress.org/plugins/everest-forms/";s:7:"package";s:62:"https://downloads.wordpress.org/plugin/everest-forms.1.7.2.zip";s:5:"icons";a:2:{s:2:"1x";s:58:"https://ps.w.org/everest-forms/assets/icon.svg?rev=2340858";s:3:"svg";s:58:"https://ps.w.org/everest-forms/assets/icon.svg?rev=2340858";}s:7:"banners";a:1:{s:2:"1x";s:68:"https://ps.w.org/everest-forms/assets/banner-772x250.png?rev=2123602";}s:11:"banners_rtl";a:0:{}}s:30:"export-media-library/index.php";O:8:"stdClass":9:{s:2:"id";s:34:"w.org/plugins/export-media-library";s:4:"slug";s:20:"export-media-library";s:6:"plugin";s:30:"export-media-library/index.php";s:11:"new_version";s:5:"3.0.1";s:3:"url";s:51:"https://wordpress.org/plugins/export-media-library/";s:7:"package";s:69:"https://downloads.wordpress.org/plugin/export-media-library.3.0.1.zip";s:5:"icons";a:1:{s:7:"default";s:64:"https://s.w.org/plugins/geopattern-icon/export-media-library.svg";}s:7:"banners";a:0:{}s:11:"banners_rtl";a:0:{}}s:50:"google-analytics-for-wordpress/googleanalytics.php";O:8:"stdClass":9:{s:2:"id";s:44:"w.org/plugins/google-analytics-for-wordpress";s:4:"slug";s:30:"google-analytics-for-wordpress";s:6:"plugin";s:50:"google-analytics-for-wordpress/googleanalytics.php";s:11:"new_version";s:6:"7.13.0";s:3:"url";s:61:"https://wordpress.org/plugins/google-analytics-for-wordpress/";s:7:"package";s:80:"https://downloads.wordpress.org/plugin/google-analytics-for-wordpress.7.13.0.zip";s:5:"icons";a:3:{s:2:"2x";s:83:"https://ps.w.org/google-analytics-for-wordpress/assets/icon-256x256.png?rev=1598927";s:2:"1x";s:75:"https://ps.w.org/google-analytics-for-wordpress/assets/icon.svg?rev=1598927";s:3:"svg";s:75:"https://ps.w.org/google-analytics-for-wordpress/assets/icon.svg?rev=1598927";}s:7:"banners";a:2:{s:2:"2x";s:86:"https://ps.w.org/google-analytics-for-wordpress/assets/banner-1544x500.png?rev=2159532";s:2:"1x";s:85:"https://ps.w.org/google-analytics-for-wordpress/assets/banner-772x250.png?rev=2159532";}s:11:"banners_rtl";a:0:{}}s:37:"mailchimp-for-wp/mailchimp-for-wp.php";O:8:"stdClass":9:{s:2:"id";s:30:"w.org/plugins/mailchimp-for-wp";s:4:"slug";s:16:"mailchimp-for-wp";s:6:"plugin";s:37:"mailchimp-for-wp/mailchimp-for-wp.php";s:11:"new_version";s:5:"4.8.1";s:3:"url";s:47:"https://wordpress.org/plugins/mailchimp-for-wp/";s:7:"package";s:65:"https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.8.1.zip";s:5:"icons";a:2:{s:2:"2x";s:69:"https://ps.w.org/mailchimp-for-wp/assets/icon-256x256.png?rev=1224577";s:2:"1x";s:69:"https://ps.w.org/mailchimp-for-wp/assets/icon-128x128.png?rev=1224577";}s:7:"banners";a:1:{s:2:"1x";s:71:"https://ps.w.org/mailchimp-for-wp/assets/banner-772x250.png?rev=1184706";}s:11:"banners_rtl";a:0:{}}s:31:"page-links-to/page-links-to.php";O:8:"stdClass":9:{s:2:"id";s:27:"w.org/plugins/page-links-to";s:4:"slug";s:13:"page-links-to";s:6:"plugin";s:31:"page-links-to/page-links-to.php";s:11:"new_version";s:5:"3.3.4";s:3:"url";s:44:"https://wordpress.org/plugins/page-links-to/";s:7:"package";s:62:"https://downloads.wordpress.org/plugin/page-links-to.3.3.4.zip";s:5:"icons";a:1:{s:7:"default";s:64:"https://s.w.org/plugins/geopattern-icon/page-links-to_fafafa.svg";}s:7:"banners";a:2:{s:2:"2x";s:69:"https://ps.w.org/page-links-to/assets/banner-1544x500.png?rev=1889711";s:2:"1x";s:68:"https://ps.w.org/page-links-to/assets/banner-772x250.png?rev=1889711";}s:11:"banners_rtl";a:0:{}}s:37:"post-types-order/post-types-order.php";O:8:"stdClass":9:{s:2:"id";s:30:"w.org/plugins/post-types-order";s:4:"slug";s:16:"post-types-order";s:6:"plugin";s:37:"post-types-order/post-types-order.php";s:11:"new_version";s:7:"1.9.5.2";s:3:"url";s:47:"https://wordpress.org/plugins/post-types-order/";s:7:"package";s:67:"https://downloads.wordpress.org/plugin/post-types-order.1.9.5.2.zip";s:5:"icons";a:1:{s:2:"1x";s:69:"https://ps.w.org/post-types-order/assets/icon-128x128.png?rev=1226428";}s:7:"banners";a:2:{s:2:"2x";s:72:"https://ps.w.org/post-types-order/assets/banner-1544x500.png?rev=1675574";s:2:"1x";s:71:"https://ps.w.org/post-types-order/assets/banner-772x250.png?rev=1429949";}s:11:"banners_rtl";a:0:{}}s:37:"recent-posts-widget-extended/rpwe.php";O:8:"stdClass":9:{s:2:"id";s:42:"w.org/plugins/recent-posts-widget-extended";s:4:"slug";s:28:"recent-posts-widget-extended";s:6:"plugin";s:37:"recent-posts-widget-extended/rpwe.php";s:11:"new_version";s:7:"0.9.9.7";s:3:"url";s:59:"https://wordpress.org/plugins/recent-posts-widget-extended/";s:7:"package";s:79:"https://downloads.wordpress.org/plugin/recent-posts-widget-extended.0.9.9.7.zip";s:5:"icons";a:1:{s:2:"1x";s:81:"https://ps.w.org/recent-posts-widget-extended/assets/icon-128x128.png?rev=1240338";}s:7:"banners";a:1:{s:2:"1x";s:82:"https://ps.w.org/recent-posts-widget-extended/assets/banner-772x250.png?rev=900647";}s:11:"banners_rtl";a:0:{}}s:39:"resmushit-image-optimizer/resmushit.php";O:8:"stdClass":9:{s:2:"id";s:39:"w.org/plugins/resmushit-image-optimizer";s:4:"slug";s:25:"resmushit-image-optimizer";s:6:"plugin";s:39:"resmushit-image-optimizer/resmushit.php";s:11:"new_version";s:6:"0.3.11";s:3:"url";s:56:"https://wordpress.org/plugins/resmushit-image-optimizer/";s:7:"package";s:75:"https://downloads.wordpress.org/plugin/resmushit-image-optimizer.0.3.11.zip";s:5:"icons";a:2:{s:2:"2x";s:78:"https://ps.w.org/resmushit-image-optimizer/assets/icon-256x256.png?rev=1447284";s:2:"1x";s:78:"https://ps.w.org/resmushit-image-optimizer/assets/icon-128x128.png?rev=1447284";}s:7:"banners";a:2:{s:2:"2x";s:81:"https://ps.w.org/resmushit-image-optimizer/assets/banner-1544x500.png?rev=2296679";s:2:"1x";s:80:"https://ps.w.org/resmushit-image-optimizer/assets/banner-772x250.png?rev=2296679";}s:11:"banners_rtl";a:0:{}}s:29:"rss-importer/rss-importer.php";O:8:"stdClass":9:{s:2:"id";s:26:"w.org/plugins/rss-importer";s:4:"slug";s:12:"rss-importer";s:6:"plugin";s:29:"rss-importer/rss-importer.php";s:11:"new_version";s:3:"0.2";s:3:"url";s:43:"https://wordpress.org/plugins/rss-importer/";s:7:"package";s:55:"https://downloads.wordpress.org/plugin/rss-importer.zip";s:5:"icons";a:3:{s:2:"2x";s:65:"https://ps.w.org/rss-importer/assets/icon-256x256.png?rev=1908375";s:2:"1x";s:57:"https://ps.w.org/rss-importer/assets/icon.svg?rev=1908375";s:3:"svg";s:57:"https://ps.w.org/rss-importer/assets/icon.svg?rev=1908375";}s:7:"banners";a:1:{s:2:"1x";s:66:"https://ps.w.org/rss-importer/assets/banner-772x250.png?rev=547674";}s:11:"banners_rtl";a:0:{}}s:37:"spacious-toolkit/spacious-toolkit.php";O:8:"stdClass":9:{s:2:"id";s:30:"w.org/plugins/spacious-toolkit";s:4:"slug";s:16:"spacious-toolkit";s:6:"plugin";s:37:"spacious-toolkit/spacious-toolkit.php";s:11:"new_version";s:5:"1.0.2";s:3:"url";s:47:"https://wordpress.org/plugins/spacious-toolkit/";s:7:"package";s:65:"https://downloads.wordpress.org/plugin/spacious-toolkit.1.0.2.zip";s:5:"icons";a:2:{s:2:"2x";s:69:"https://ps.w.org/spacious-toolkit/assets/icon-256x256.png?rev=1832031";s:2:"1x";s:69:"https://ps.w.org/spacious-toolkit/assets/icon-256x256.png?rev=1832031";}s:7:"banners";a:1:{s:2:"1x";s:71:"https://ps.w.org/spacious-toolkit/assets/banner-772x250.png?rev=1832019";}s:11:"banners_rtl";a:0:{}}s:33:"w3-total-cache/w3-total-cache.php";O:8:"stdClass":9:{s:2:"id";s:28:"w.org/plugins/w3-total-cache";s:4:"slug";s:14:"w3-total-cache";s:6:"plugin";s:33:"w3-total-cache/w3-total-cache.php";s:11:"new_version";s:6:"0.15.1";s:3:"url";s:45:"https://wordpress.org/plugins/w3-total-cache/";s:7:"package";s:64:"https://downloads.wordpress.org/plugin/w3-total-cache.0.15.1.zip";s:5:"icons";a:2:{s:2:"2x";s:67:"https://ps.w.org/w3-total-cache/assets/icon-256x256.png?rev=1041806";s:2:"1x";s:67:"https://ps.w.org/w3-total-cache/assets/icon-128x128.png?rev=1041806";}s:7:"banners";a:1:{s:2:"1x";s:69:"https://ps.w.org/w3-total-cache/assets/banner-772x250.jpg?rev=1041806";}s:11:"banners_rtl";a:0:{}}s:27:"woocommerce/woocommerce.php";O:8:"stdClass":9:{s:2:"id";s:25:"w.org/plugins/woocommerce";s:4:"slug";s:11:"woocommerce";s:6:"plugin";s:27:"woocommerce/woocommerce.php";s:11:"new_version";s:5:"4.6.2";s:3:"url";s:42:"https://wordpress.org/plugins/woocommerce/";s:7:"package";s:60:"https://downloads.wordpress.org/plugin/woocommerce.4.6.2.zip";s:5:"icons";a:2:{s:2:"2x";s:64:"https://ps.w.org/woocommerce/assets/icon-256x256.png?rev=2366418";s:2:"1x";s:64:"https://ps.w.org/woocommerce/assets/icon-128x128.png?rev=2366418";}s:7:"banners";a:2:{s:2:"2x";s:67:"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=2366418";s:2:"1x";s:66:"https://ps.w.org/woocommerce/assets/banner-772x250.png?rev=2366418";}s:11:"banners_rtl";a:0:{}}s:57:"woocommerce-gateway-stripe/woocommerce-gateway-stripe.php";O:8:"stdClass":9:{s:2:"id";s:40:"w.org/plugins/woocommerce-gateway-stripe";s:4:"slug";s:26:"woocommerce-gateway-stripe";s:6:"plugin";s:57:"woocommerce-gateway-stripe/woocommerce-gateway-stripe.php";s:11:"new_version";s:5:"4.5.3";s:3:"url";s:57:"https://wordpress.org/plugins/woocommerce-gateway-stripe/";s:7:"package";s:75:"https://downloads.wordpress.org/plugin/woocommerce-gateway-stripe.4.5.3.zip";s:5:"icons";a:2:{s:2:"2x";s:79:"https://ps.w.org/woocommerce-gateway-stripe/assets/icon-256x256.png?rev=1917495";s:2:"1x";s:79:"https://ps.w.org/woocommerce-gateway-stripe/assets/icon-128x128.png?rev=1917495";}s:7:"banners";a:2:{s:2:"2x";s:82:"https://ps.w.org/woocommerce-gateway-stripe/assets/banner-1544x500.png?rev=1917495";s:2:"1x";s:81:"https://ps.w.org/woocommerce-gateway-stripe/assets/banner-772x250.png?rev=1917495";}s:11:"banners_rtl";a:0:{}}s:53:"wpfront-user-role-editor/wpfront-user-role-editor.php";O:8:"stdClass":9:{s:2:"id";s:38:"w.org/plugins/wpfront-user-role-editor";s:4:"slug";s:24:"wpfront-user-role-editor";s:6:"plugin";s:53:"wpfront-user-role-editor/wpfront-user-role-editor.php";s:11:"new_version";s:6:"2.14.4";s:3:"url";s:55:"https://wordpress.org/plugins/wpfront-user-role-editor/";s:7:"package";s:74:"https://downloads.wordpress.org/plugin/wpfront-user-role-editor.2.14.4.zip";s:5:"icons";a:3:{s:2:"2x";s:77:"https://ps.w.org/wpfront-user-role-editor/assets/icon-256x256.png?rev=1022726";s:2:"1x";s:69:"https://ps.w.org/wpfront-user-role-editor/assets/icon.svg?rev=1022723";s:3:"svg";s:69:"https://ps.w.org/wpfront-user-role-editor/assets/icon.svg?rev=1022723";}s:7:"banners";a:1:{s:2:"1x";s:78:"https://ps.w.org/wpfront-user-role-editor/assets/banner-772x250.png?rev=875133";}s:11:"banners_rtl";a:0:{}}s:35:"wp-mapbox-gl-js/wp-mapbox-gl-js.php";O:8:"stdClass":9:{s:2:"id";s:29:"w.org/plugins/wp-mapbox-gl-js";s:4:"slug";s:15:"wp-mapbox-gl-js";s:6:"plugin";s:35:"wp-mapbox-gl-js/wp-mapbox-gl-js.php";s:11:"new_version";s:5:"3.0.0";s:3:"url";s:46:"https://wordpress.org/plugins/wp-mapbox-gl-js/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/wp-mapbox-gl-js.zip";s:5:"icons";a:2:{s:2:"2x";s:68:"https://ps.w.org/wp-mapbox-gl-js/assets/icon-256x256.png?rev=1877547";s:2:"1x";s:68:"https://ps.w.org/wp-mapbox-gl-js/assets/icon-128x128.png?rev=1877547";}s:7:"banners";a:2:{s:2:"2x";s:71:"https://ps.w.org/wp-mapbox-gl-js/assets/banner-1544x500.png?rev=1877547";s:2:"1x";s:70:"https://ps.w.org/wp-mapbox-gl-js/assets/banner-772x250.png?rev=1877547";}s:11:"banners_rtl";a:0:{}}s:21:"wp-redis/wp-redis.php";O:8:"stdClass":9:{s:2:"id";s:22:"w.org/plugins/wp-redis";s:4:"slug";s:8:"wp-redis";s:6:"plugin";s:21:"wp-redis/wp-redis.php";s:11:"new_version";s:5:"1.1.1";s:3:"url";s:39:"https://wordpress.org/plugins/wp-redis/";s:7:"package";s:57:"https://downloads.wordpress.org/plugin/wp-redis.1.1.1.zip";s:5:"icons";a:2:{s:2:"2x";s:61:"https://ps.w.org/wp-redis/assets/icon-256x256.png?rev=2252965";s:2:"1x";s:61:"https://ps.w.org/wp-redis/assets/icon-128x128.png?rev=2252965";}s:7:"banners";a:2:{s:2:"2x";s:64:"https://ps.w.org/wp-redis/assets/banner-1544x500.png?rev=2252965";s:2:"1x";s:63:"https://ps.w.org/wp-redis/assets/banner-772x250.png?rev=2252965";}s:11:"banners_rtl";a:0:{}}s:39:"wp-rss-aggregator/wp-rss-aggregator.php";O:8:"stdClass":9:{s:2:"id";s:31:"w.org/plugins/wp-rss-aggregator";s:4:"slug";s:17:"wp-rss-aggregator";s:6:"plugin";s:39:"wp-rss-aggregator/wp-rss-aggregator.php";s:11:"new_version";s:6:"4.17.8";s:3:"url";s:48:"https://wordpress.org/plugins/wp-rss-aggregator/";s:7:"package";s:67:"https://downloads.wordpress.org/plugin/wp-rss-aggregator.4.17.8.zip";s:5:"icons";a:2:{s:2:"2x";s:70:"https://ps.w.org/wp-rss-aggregator/assets/icon-256x256.png?rev=1823609";s:2:"1x";s:70:"https://ps.w.org/wp-rss-aggregator/assets/icon-128x128.png?rev=1823609";}s:7:"banners";a:2:{s:2:"2x";s:73:"https://ps.w.org/wp-rss-aggregator/assets/banner-1544x500.png?rev=2040548";s:2:"1x";s:72:"https://ps.w.org/wp-rss-aggregator/assets/banner-772x250.png?rev=2210123";}s:11:"banners_rtl";a:0:{}}s:33:"wp-user-avatar/wp-user-avatar.php";O:8:"stdClass":9:{s:2:"id";s:28:"w.org/plugins/wp-user-avatar";s:4:"slug";s:14:"wp-user-avatar";s:6:"plugin";s:33:"wp-user-avatar/wp-user-avatar.php";s:11:"new_version";s:5:"2.2.7";s:3:"url";s:45:"https://wordpress.org/plugins/wp-user-avatar/";s:7:"package";s:63:"https://downloads.wordpress.org/plugin/wp-user-avatar.2.2.7.zip";s:5:"icons";a:2:{s:2:"2x";s:67:"https://ps.w.org/wp-user-avatar/assets/icon-256x256.png?rev=1755722";s:2:"1x";s:67:"https://ps.w.org/wp-user-avatar/assets/icon-128x128.png?rev=1755722";}s:7:"banners";a:1:{s:2:"1x";s:68:"https://ps.w.org/wp-user-avatar/assets/banner-772x250.png?rev=882713";}s:11:"banners_rtl";a:0:{}}s:24:"wordpress-seo/wp-seo.php";O:8:"stdClass":9:{s:2:"id";s:27:"w.org/plugins/wordpress-seo";s:4:"slug";s:13:"wordpress-seo";s:6:"plugin";s:24:"wordpress-seo/wp-seo.php";s:11:"new_version";s:6:"15.2.1";s:3:"url";s:44:"https://wordpress.org/plugins/wordpress-seo/";s:7:"package";s:63:"https://downloads.wordpress.org/plugin/wordpress-seo.15.2.1.zip";s:5:"icons";a:3:{s:2:"2x";s:66:"https://ps.w.org/wordpress-seo/assets/icon-256x256.png?rev=2363699";s:2:"1x";s:58:"https://ps.w.org/wordpress-seo/assets/icon.svg?rev=2363699";s:3:"svg";s:58:"https://ps.w.org/wordpress-seo/assets/icon.svg?rev=2363699";}s:7:"banners";a:2:{s:2:"2x";s:69:"https://ps.w.org/wordpress-seo/assets/banner-1544x500.png?rev=1843435";s:2:"1x";s:68:"https://ps.w.org/wordpress-seo/assets/banner-772x250.png?rev=1843435";}s:11:"banners_rtl";a:2:{s:2:"2x";s:73:"https://ps.w.org/wordpress-seo/assets/banner-1544x500-rtl.png?rev=1843435";s:2:"1x";s:72:"https://ps.w.org/wordpress-seo/assets/banner-772x250-rtl.png?rev=1843435";}}}s:7:"checked";a:14:{s:39:"search-filter-pro/search-filter-pro.php";s:5:"2.5.1";s:39:"wp-rss-categories/wp-rss-categories.php";s:5:"1.3.3";s:43:"wp-rss-feed-to-post/wp-rss-feed-to-post.php";s:6:"3.13.3";s:43:"wp-rss-full-text-feeds/wp-rss-full-text.php";s:5:"1.3.2";s:53:"wp-rss-keyword-filtering/wp-rss-keyword-filtering.php";s:3:"1.7";s:41:"wp-rss-templates-0.2/wp-rss-templates.php";s:3:"0.2";s:47:"wpai-linkcloak-add-on/wpai-linkcloak-add-on.php";s:5:"1.1.3";s:39:"wp-all-export-pro/wp-all-export-pro.php";s:5:"1.6.2";s:39:"wp-all-import-pro/wp-all-import-pro.php";s:5:"4.6.5";s:45:"wpae-user-add-on-pro/wpae-user-add-on-pro.php";s:5:"1.0.3";s:35:"wpai-acf-add-on/wpai-acf-add-on.php";s:5:"3.2.9";s:37:"wpai-user-add-on/wpai-user-add-on.php";s:5:"1.1.4";s:51:"wpai-woocommerce-add-on/wpai-woocommerce-add-on.php";s:5:"3.2.5";s:31:"elementor-pro/elementor-pro.php";s:5:"3.0.6";}}}