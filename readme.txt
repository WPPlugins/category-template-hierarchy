=== Category Template Hierarchy ===
Contributors: eddiemoya
Donate link: http://eddiemoya.com
Tags: plugin, theme development, theme, template, hierarchy, category, template hierarchy, subcategory, parent category, child category, parent category, category template
Requires at least: unknown
Tested up to: 3.2.1
Stable tag: 1.0.5

Adds parent-category.php & child-category.php templates to the template hierarchy with all the normal hierarchical behavior with conditional tags to match.

== Description ==

Adds `parent-category.php` and `child-category.php` with all the normal hierarchical behavior of the native category templates. This greatly extends the natural hierarchy of theme templates with regard to categories. Theme developers can now easily create separate templates for categories with have children, the children themselves, and categories which are neither.

Also adds `is_parent_category()` and `is_child_category()` functions for easy use in themes.

Note: This plugin does not actually create parent-category.php, child-category.php or any of their related templates - rather it modifies the native [template hierarchy]( to allow theme developers to create specific templates for parent and child categories

== Developer Notes: Template Hierarchy ==

What follows are the lists by which the new hierarchical elements will cascade - realize that all these lists are essentially just branches off of the existing [Template Hierarchy](http://codex.wordpress.org/Template_Hierarchy#Visual_Overview).

If category has no children and has no parent (stand-alone category):

* category-{slug}.php
* category-{term_id}.php
* category.php
* archive.php
* index.php
  
If category is a parent (has children):

* parent-category-{slug}.php
* parent-category-{term_id}.php
* parent-category.php
* category.php
* archive.php
* index.php

If category is a child (has a parent):

* child-category-{slug}.php
* child-category-{term_id}.php
* child-category.php
* category.php
* archive.php
* index.php



== Developer Notes: Conditional Tags ==

With this plugin comes two additional [conditional tags](http://codex.wordpress.org/Conditional_Tags) which behave much like any other in WordPress. In a similar fashion to how one might use [is_category()](http://codex.wordpress.org/Function_Reference/is_category), developers may, with this plugin, use the following functions:

* is_parent_category()
* is_child_category()

= Description =
These conditional tags checks if the page being displayed is for hierarchical category that has children (e.g. is a parent category), or has a parent (is a child) respectively. They are boolean functions, meaning they return either TRUE or FALSE.

= Usage =
`
<?php is_parent_category( $category ); ?>
//AND
<?php is_child_category( $category ); ?>
`


= Parameters =

$category (integer/string/object) (optional) Category ID, Category Slug, Category Object. Default: Current Category

Note: Unlike is_category(), these functions will not take arrays of categories or category titles. I'll work on that. Sorry.

= Return Values =
(boolean) True on success, false on failure.

= Examples =
`
is_parent_category()
is_child_category()
// When any parent/child category archive page is being displayed

is_parent_category( '9' );
is_child_category( '9' );
// When the archive page for Category 9 is being displayed AND its a parent/child.

is_parent_category( 'blue-cheese' );
is_child_category( 'blue-cheese' );
// When the archive page for the Category with Category Slug "blue-cheese" is being displayed AND its a parent/child.
`
= Notes =
* Clearly there is a need to have is_child_category_of() and is_parent_category_of(). They will be made available in future releases.

== Known Bugs ==

1. [Fixed] In 1.0 and 1.0.1 there was a "happy accident" which I permitted, wherein if a category was both a parent and a child, it would look for a parent-child-category.php chain of templates. I later realized that in such a case the plugin would _only_ look for that chain, as it would overwrite the previous chain of templates. 1.0.2 eliminated this "happy accident"

1. [Future fix] Revealed by bug #1, the current logic makes it such that if a category is both a parent and a child, the child relationship will take precedence over the parent relationship. In such a case, only the child-category.php chain of templates will work with for that category.







== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Do you have any Frequently Asked Questions? =

No.

= Why not? =

Because I only just recently released the plugin. I feel that I've done a decent job of documentation, so I can't guess what people may ask on this broadly applicable plugin.

= Can I ask you a question =

Please do! Feel free to ask on the tools provided right in the WordPress plugin directory, or on my website [eddiemoya.com](http://eddiemoya.com/)
No, plugins are not loaded during installation. For alternative solutions see 
"Other manifestations, alternative solutions" on the plugin home page.

== Upgrade Notice ==

= 1.0.5
Please upgrade to 1.0.5 - Packaging problem fixed. Several basic bug fixes

= 1.0.3 =
Please upgrade to 1.0.3. is_parent_category() and is_child_category() bugs fixed.

= 1.0.2 =
Please upgrade to 1.0.2. Bugs in 1.0.1 and below may cause some category templates to map incorrectly.

= 1.0.1 =
Please upgrade to 1.0.1. Bugs in 1.0 may cause a white screen.

== Changelog ==


= 1.0.5 =
* Packaging problem fixed - the plugin was incorrectly packaged, such that it failed on activation.
* Fixed several other very bad bugs

= 1.0.3 =
* Fixed problems with the is_parent_category() and is_child_category() functions where they returned `null` if called from a non-category page. 

= 1.0.2 =
* Removed the 'happy accident' wherein a category which is both a parent and a child results in a hierarchy based on parent-child-categroy.php. This reveals a more important problem which I plan to fix for version 1.1.

= 1.0.1 =
* Fixed a silly bug. Misspelled `is_numberic` rather than `is_numeric`.
* Removed unnecessary `exit`.

= 1.0 =
* Initial commit.
