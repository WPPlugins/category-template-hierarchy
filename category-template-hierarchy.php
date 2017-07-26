<?php
/*
Plugin Name: Category Template Hierarchy
Plugin URI: eddiemoya.com
Description:  Adds parent-category.php & child-category.php to the template hierarchy with all the normal hierarchical behavior with conditional tags to match: is_child_category() and is_parent_category()
Author: Eddie Moya
Version: 1.0.5
*/

/**
 * @todo Add is_child_of(), is_parent_of() functions, and create similarly fashioned template redirections - such that you could have a template named child-of-category-#.php
 */

class Category_Template_Hierarchy {
    
    /**
     * @author Eddie Moya
     * 
     * Start your engines.
     */
    function init(){
        add_action('template_redirect', array( __CLASS__,'category_relationship'));
    }
    
    /**
     * @author Eddie Moya
     * 
     * Determines the correct relationship status of a category and redirects accordingly.
     */
    function category_relationship() {
        $template_prefix = "";
  
        if (is_parent_category()) 
            $template_prefix = "parent-";
            
        if(is_child_category())
            $template_prefix = "child-";
            
        self::category_template_redirect($category, $template_prefix);
 
    }
    
    /**
     * @author Eddie Moya
     * 
     * @param int|str|obj $category The category to be applied for this template. Can be Cat ID, Cat Slug or the Category Object. Sorry, no titles or arrays.
     * @param string $template_prefix [optional] The prefix to add to the base template.
     * @param string $template [optional] The base type of template to use. This is here to allow for expansion later, which might expand upon other part of the standard TH
     */
    function category_template_redirect($category = null, $template_prefix = "", $template = "category") {
        
        $category = (is_numeric($category)) ? get_the_category($category)   : $category;
        $category = (is_string($category))  ? get_category_by_slug()        : $category;
        $category = (empty($category))      ? get_queried_object()          : $category;

        $template_name = $template_prefix . $template;

        $templates = array();

        $templates[] = "{$template_name}-{$category->slug}.php";
        $templates[] = "{$template_name}-{$category->term_id}.php";
        $templates[] = "{$template_name}.php";
        $templates[] = "{$template}.php";
        $templates[] = "archive.php";
        $templates[] = "index.php";
        include( get_query_template($template_name, $templates));
        exit;
    }
}
Category_Template_Hierarchy::init();


/**
 * @author Eddie Moya
 * 
 * This conditional tag checks if the page being displayed is for hierarchical category that has children (e.g. is a parent category).
 * 
 * @param object $category [optional] Category object. Default: Current Category
 * @return bool Returns true if category is a parent, otherwise returns false.
 */
function is_parent_category($category = null){
   
    $category = (is_numeric($category)) ? get_the_category($category)   : $category;
    $category = (is_string($category))  ? get_category_by_slug()        : $category;
    $category = (empty($category))      ? get_queried_object()          : $category;
    
    $children = get_categories("parent={$category->term_id}&hide_empty=0");
    $is_parent = empty($children) ? false : true;
    return $is_parent;
}

/**
 * @author Eddie Moya
 * 
 * This conditional tag checks if the page being displayed is for hierarchical category that has parent (e.g. is a child category).
 * 
 * @param object $category [optional] Category object. Default Current Category
 * @return bool Returns true if category has a parent, otherwise returns false.
 */
function is_child_category($category = null){
    
    $category = (is_numeric($category)) ? get_the_category($category)   : $category;
    $category = (is_string($category))  ? get_category_by_slug()        : $category;
    $category = (empty($category))      ? get_queried_object()          : $category;
   
    $is_child = empty($category->parent) ? false : true;
    return $is_child;
}

