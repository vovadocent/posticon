<?php

/**
 * PI Admin
 *
 * @package PI
 */
defined('ABSPATH') || exit;

/**
 * Stock_Finder Class.
 */
class PI_Admin {

    protected $options;
    public $positions = array( 'left', 'right' );
    public $icons = array(  'menu','admin-site','dashboard','admin-post','admin-media','admin-links','admin-page',
                            'admin-comments','admin-appearance','admin-plugins','admin-users','admin-tools',
                            'admin-settings','admin-network','admin-home','admin-generic','admin-collapse',
                            'welcome-write-blog','welcome-add-page','welcome-view-site','welcome-widgets-menus',
                            'welcome-comments','welcome-learn-more','format-aside','format-image','format-gallery',
                            'format-video','format-status','format-quote','format-chat','format-audio','camera','images-alt',
                            'images-alt2','video-alt','video-alt2','video-alt3','image-crop','image-rotate-left',
                            'image-rotate-right','image-flip-vertical','image-flip-horizontal','undo','redo','editor-bold',
                            'editor-italic','editor-ul','editor-ol','editor-quote','editor-alignleft','editor-aligncenter',
                            'editor-alignright','editor-insertmore','editor-spellcheck','editor-distractionfree',
                            'editor-kitchensink','editor-underline','editor-justify','editor-textcolor','editor-paste-word',
                            'editor-paste-text','editor-removeformatting','editor-video','editor-customchar','editor-outdent',
                            'editor-indent','editor-help','editor-strikethrough','editor-unlink','editor-rtl','align-left',
                            'align-right','align-center','align-none','lock','calendar','visibility','post-status','edit',
                            'trash','arrow-up','arrow-down','arrow-right','arrow-left','arrow-up-alt','arrow-down-alt',
                            'arrow-right-alt','arrow-left-alt','arrow-up-alt2','arrow-down-alt2','arrow-right-alt2',
                            'arrow-left-alt2','sort','leftright','list-view','exerpt-view','share','share-alt','share-alt2',
                            'twitter','rss','facebook','facebook-alt','googleplus','networking','hammer','art','migrate',
                            'performance','wordpress','wordpress-alt','pressthis','update','screenoptions','info','cart',
                            'feedback','cloud','translation','tag','category','yes','no','no-alt','plus','minus','dismiss',
                            'marker','star-filled','star-half','star-empty','flag','location','location-alt','vault','shield',
                            'shield-alt','search','slides','analytics','chart-pie','chart-bar','chart-line','chart-area',
                            'groups','businessman','id','id-alt','products','awards','forms','portfolio','book','book-alt',
                            'download','upload','backup','lightbulb','smiley' );

    public function __construct() {
        $this->options = $this->get_options();
    }

    /**
     * Get Plugin Options
     * @return array
     */
    public function get_options() {
        $options = get_option('pi_options');
        if (empty($options)) {
            $options = array(
                'pi_enabled' => false,
                'pi_posts' => array(),
            );
        }
        return $options;
    }

    /**
     * Render the admin Settings submenu
     */
    public static function options_submenu() {
        $pi_admin = new self();

        add_submenu_page(
                'options-general.php',
                'Post Icon Options',
                'Post Icon',
                'administrator',
                'pi-options',
                array($pi_admin, 'admin_settings_page')
        );
    }

    /**
     * Admin Settings Page
     */
    public function admin_settings_page() {

        $action = filter_input(INPUT_POST, 'action');
        if (!empty($action) && $action == 'pi_save_settings')
            $this->save_options();

        $options = $this->get_options();
        $posts = $this->get_posts();
        $positions = $this->positions;
        $icons = $this->icons;

        include_once PI_ADMIN_TPL_PATH . '/settings.php';
    }

    /**
     * Admin Save Settings
     */
    protected function save_options() {

        $pi_enabled = boolval(filter_input(INPUT_POST, 'pi_enabled'));
        $_pi_posts = filter_input(INPUT_POST, 'pi_posts', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $_icon_positions = filter_input(INPUT_POST, 'icon_positions', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $_icons = filter_input(INPUT_POST, 'icons', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

        $pi_posts = array();
        if( !empty($_pi_posts) ){
            foreach( $_pi_posts as $post_id){
                $pi_posts[$post_id] = array(
                    'position' => $_icon_positions[ $post_id ],
                    'icon' => $_icons[ $post_id ],
                );
            }
        }

        $options = array(
            'pi_enabled' => $pi_enabled,
            'pi_posts' => $pi_posts,
        );
        update_option('pi_options', $options);
    }

    /**
     * Get Posts
     */
    protected function get_posts() {
        global $wpdb;
        $post_type = 'post';
        $sql = "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = '$post_type' AND post_status = 'publish'";
        $posts = $wpdb->get_results( $sql );

        return $posts;
    }

}
