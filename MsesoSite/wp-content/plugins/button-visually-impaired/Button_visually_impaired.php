<?php
/**
 * Button visually impaired
 * Plugin Name: Button visually impaired
 * Plugin URI: http://www.bvi.isvek.ru/
 * Description: Демо версия плагина для слабовидящих.
 * Version: 0.5.2
 * Author: Vek
 * Author URI: http://www.isvek.ru/vek
 */

class Button_visually_impaired
{
    public $plugin_name = 'Button visually impaired';
    public $ver = '0.5.2';

    public function __construct()
    {
        add_action('plugins_loaded', array(&$this,'constants'));
        add_action('admin_menu', array(&$this,'add_plugin_menu'));
        add_action('wp_enqueue_scripts', array(&$this,'scripts'));
        add_action('wp_enqueue_scripts', array(&$this,'css'));
    }

    public function constants()
    {
        define('BVI_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('BVI_PLUGIN_URL', plugin_dir_url(__FILE__));
        define('BVI_PLUGIN_ADMIN', BVI_PLUGIN_DIR.'assets/pages/');
        define('BVI_PLUGIN_CSS', BVI_PLUGIN_URL.'assets/css/');
        define('BVI_PLUGIN_JS', BVI_PLUGIN_URL.'assets/js/');
        define('BVI_PLUGIN_IMG', BVI_PLUGIN_URL.'assets/img/');
    }

    public function admin_scripts()
    {
        //admin_scripts
    }

    public function admin_css()
    {
        //admin_css
    }

    public function scripts()
    {
        wp_enqueue_script('jquery');

        wp_register_script('bvi-settings', BVI_PLUGIN_JS.'bvi.js', array('jquery'), $this->ver, true);
        wp_enqueue_script('bvi-settings');

        wp_register_script('bvi-panel',BVI_PLUGIN_JS.'bvi.panel.js', array('jquery'),'0.1', true);
        wp_enqueue_script('bvi-panel');

        wp_register_script('bvi-cookie',BVI_PLUGIN_JS.'js.cookie.js', array('jquery'),'2.0.4', true);
        wp_enqueue_script('bvi-cookie');
    }

    public function css()
    {
        wp_register_style('bvi-style',BVI_PLUGIN_CSS.'bvi-style.css','','0.8');
        wp_enqueue_style('bvi-style');

        wp_register_style('bvi-animate',BVI_PLUGIN_CSS.'animate.min.css','','3.5.1');
        wp_enqueue_style('bvi-animate');

        wp_register_style('bvi-font-awesome',BVI_PLUGIN_CSS.'font-awesome.min.css','','4.5.0');
        wp_enqueue_style('bvi-font-awesome');
    }

    public function add_plugin_menu()
    {
        if (function_exists('add_menu_page')){
            $admin_menu = add_menu_page(
                "Плагин для слабовидящих bvi v{$this->ver}",
                "bvi v{$this->ver}",
                'administrator',
                'bvi',
                array (&$this, 'settings_page'),
                'dashicons-visibility'
            );
            add_action("admin_print_scripts-{$admin_menu}",array($this,'admin_scripts'));
            add_action("admin_print_scripts-{$admin_menu}",array($this,'admin_css'));
        }
    }

    public function settings_page()
    {
        if (current_user_can('administrator'))
        {
            if(file_exists(BVI_PLUGIN_ADMIN.'admin.php'))
            {
                require_once (BVI_PLUGIN_ADMIN.'admin.php');
            }
            else
            {
                echo '<div class="wrap"><h1>Страница не найдена</h1></div>';
            }
        }
    }
}
$Settings = new Button_visually_impaired();

class Button_visually_impaired_Widget extends WP_Widget
{
    function Button_visually_impaired_Widget()
    {
        parent::__construct(false, 'Кнопка для слабовидящих');
    }

    function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title))
        {
            echo $args['before_title'].$title.$args['after_title'];
        }
        echo __('<div class="bvi_button">'.$this->template_button().'</div>', 'text_domain');
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']):'';
        return $instance;
    }

    function form($instance)
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Версия для слабовидящих', 'text_domain' );
        echo '<p>';
        echo '<label for="'.$this->get_field_id("title").'">'._e("Title:").'</label>';
        echo '<input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.esc_attr($title).'">';
        echo '</p>';
    }

    public function template_button()
    {
        /*return '<a href="#" class="bvi_panel_open"><i class="fa fa-eye fa-2x bvi_text-black"></i> Версия для слабовидящих</a>';*/
        return '<a href="#" class="bvi_panel_open"><i class="fa-2x bvi_text-black"></i><FONT color="red"><b>Версия для слабовидящих</b></font></a>';
	}
}
function register_foo_widget() {
    register_widget( 'Button_visually_impaired_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );