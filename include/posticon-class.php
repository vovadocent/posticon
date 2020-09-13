<?php

/**
 * PI setup
 *
 * @package PI
 */
defined('ABSPATH') || exit;

/**
 * Main PI Class.
 *
 * @class Post Icon
 */
final class Post_Icon {

    public function __construct() {

        $this->includes();
        $this->init_hooks();

        do_action('woocommerce_loaded');
    }

    /**
     * Include required core files.
     */
    private function includes() {
        include_once PI_PLUGIN_PATH . 'include/posticon-admin.php';
    }

    /**
     * Hook into actions and filters.
     */
    private function init_hooks() {

        // actions
        add_action("admin_menu", array('PI_Admin', 'options_submenu'));

        // filters
        add_filter('the_title', array($this, 'pi_hook_the_title'), 100, 2);
    }

    /**
     * The title hook
     * Add Post Icon to the tilte if enabled and configured
     */
    public function pi_hook_the_title($title, $post_id) {
        $pi_admin = new PI_Admin();
        $options = $pi_admin->get_options();
        if ($options['pi_enabled'] === true && !empty($options['pi_posts']) && isset($options['pi_posts'][$post_id])) {

            if(  in_the_loop() ){
                $opt = $options['pi_posts'][$post_id];
                $icon = "<span class='dashicons dashicons-". $opt['icon'] ."'></span>";
                $title = $opt['position'] == 'left' ? $icon . $title : $title . $icon;
            }

        }

        return $title;
    }

}
