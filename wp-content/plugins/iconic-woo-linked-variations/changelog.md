**v1.0.10** (13 Aug 2020)  
[update] Add filter `iconic_wlv_term_button_attributes`  
[update] Compatibility with WordPress 5.5  
[update] Update dependencies  


**v1.0.9** (15 Jun 2020)  
[new] Compatibility with [WooCommerce Attribute Swatches](https://iconicwp.com/products/woocommerce-attribute-swatches/)  
[update] Change data type for post_id column to bigint(20)  
[fix] WPML compatiblity - fix get_terms() issue  
[fix] Fix PHP warnings  

**v1.0.8** (21 Apr 2020)  
[update] Update dependencies  
[fix] Remove double colon when used with WooCommerce Attribute Swatches  
[fix] Ensure correct product ID is used for WPML  
[fix] Exclude `cpt_iconic_wlv` from search  

**v1.0.7** (18 Mar 2020)  
[update] Version compatibility  

**v1.0.6** (26 Sep 2019)  
[new] Added actions iconic_wlv_before_variations_display and iconic_wlv_after_variations_display  
[new] Add [iconic_wlv_links] shortcode to display product links in page builders  
[update] Update dependencies  
[fix] Ensure dropdowns don't reload the page if the location is the same  
[fix] Missing function when importing  
[fix] Issue with attribute label translation when using WPML  
[fix] Issue where active attribute was not being selected for translated WPML products  
[fix] Make sure selected group for product is published  

**v1.0.5** (1 July 2019)  
[fix] Freemius Fix  

**v1.0.4** (2 Mar 2019)  
[fix] Security Fix  

**v1.0.3** (6 Dec 2018)  
[update] Compatibility with WP 5.0  
[update] Compatibility with Woo 3.5.2  
[update] Update dependencies  
[update] Change import class to work with all post meta imports  
[fix] Ensure product IDs are saved in the same format when importing/saving  
[fix] Ensure linked variations only show when the group has a valid status  
[fix] The linked variations meta data was lost when using the wp quick editor  
[fix] Ensure variation options are displayed properly in all themes  
[fix] Linked Variations didn't appear on translated products  

**v1.0.2** (10 Sep 2018)  
[update] Add Iconic core classes  
[update] Skip option group in dropdown if no terms  

**v1.0.1** (14 Aug 2018)  
[new] Display options as dropdown or buttons  
[update] Add stock visibility and new helper classes  
[update] Add WP All Import Compatibility  
[update] Allow import by SKU  
[update] Add WPML Compatibility  
[update] Update Freemius  
[update] Update settings framework  
[update] Add some usable hooks throughout (see docs)  
[fix] Current product sometimes selected more than 1 product

**v1.0.0** (08/01/2018)  
[new] Initial Release